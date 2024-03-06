<?php
		// phan nay la lam ve nut kich hoat <?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;
use App\Services\BaseService;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\PostRepositoryInterface as PostRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;// dlanguagen de thiet lap date
use Illuminate\Support\Facades\Hash;//de // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
use Illuminate\Support\Str;

// ...








class PostService extends BaseService implements  PostServiceInterface
{
	protected $postRepository;
	
	  protected $language;
	
	public function __construct(
		PostRepository $postRepository
		


	){
		$this->language = $this->currentLanguage();
				$this->postRepository=$postRepository;

				


	}
	private function select(){
		return[
	 'posts.id',
	
	 'posts.publish',
	 'posts.image',
	  
	  'posts.order',
	 'tb2.name',
	 'tb2.canonical'

		];


	}
	private function payload(){
		return[
	    'post_catalogue_id',
		'follow',
		'publish',
		'image',
		'album',
		//'post_catalogue_id' chinh la parent_id do doi nham teen de lay ten danh muc cua bang 
		
	];
	}


	private function payloadLanguage(){
		return[
			'name',
         'canonical',
         'meta_title',
         'meta_keyword',
         'meta_description',
         'description',
         'content'
	];
	}


    // phan nay de lam ve thang post_ catalogue_post tcu la hai thaang danh muc va danh muc phu 
	private function catalogue(Request $request){
		// dd($request);
	 return array_unique(array_merge($request->input('catalogue'),[$request->post_catalogue_id]));
	//array_merge(...): Hàm array_merge được sử dụng để kết hợp các mảng. Trong trường hợp này, nó sẽ kết hợp  mảng từ input('catalogue') và mảng chứa 'post_catalogue_id', tạo ra một mảng mới chứa tất cả các giá trị từ cả hai mảng.

     
}
// 







	public function paginate($request){

//$relation tao moi quan he cho cac bnag trong du);
	

		$condition['keyword'] = addslashes($request->input('keyword'));

		//addslashes() là một hàm trong PHP được sử dụng để thêm dấu gạch chéo (\) vào trước các ký tự đặc biệt như dấu nháy đơn (')
		$condition['publish'] = $request->integer('publish');
		// dong nay de truy van tim kiem 
		$condition['post_catalogue_id'] = $request->integer('post_catalogue_id');

			$condition['where'] = [
				'tb2.language_id','=',$this->language
			];

		// dd($condition);
		// dd($condition);
		$perpage=$request->integer('perpage');
		
		// truyen thuoc tinh va muon cho du lieu vao 
		$posts=$this->postRepository->pagination($this->Select(),
			$condition,
			[
				// doan nay join sang de lay id ben post_catalogue_language de lay ra danh sach 
				['post_language as tb2', 'tb2.post_id', '=', 'posts.id'],
				['post_catalogue_post as tb3', 'posts.id', '=', 'tb3.post_id'],


			],
			['path'=>'post.post.index'],
			$perpage,
			[],
			[
			'posts.id','DESC',
		     ],
		);

	
		// dd($postCatalogue);
		return $posts;


 	}

 	// phan nay de tim kiem theo danh muc cha con 
 	private function whereRaw($request){
    $rawCondition = [];
    if($request->integer('post_catalogue_id') > 0){
        $rawCondition['whereRaw'] = [
            [
            	// phan nay la val[0]
                'tb3.post_catalogue_id IN (
                    SELECT id
                    FROM post_catalogues
                    WHERE lft >= (SELECT lft FROM post_catalogues as pc WHERE pc.id = ?)
                    AND rgt <= (SELECT rgt FROM post_catalogues as pc WHERE pc.id = ?)
                )',

                // phan nay la val[1]
                [$request->integer('post_catalogue_id'), $request->integer('post_catalogue_id')]
            ]
        ];
    }
    return $rawCondition;
}

	public function create($request){
		DB::beginTransaction();// tao ra mot  secssion
		try{
			
			// $payload=$request->input();
				//$payload=$request->except(['language_id']);//except nghia la lya tat ca ngoai tru cai gi do mk viet ben trong ham 
			$payload=$request->only($this->payload());
			// ham only chi lay nhung gia chi ma no yeu cau no nguoc voi ham except
			$payload['album'] = (isset($payload['album'] ) && !empty($payload['album']) ? json_encode($payload['album']) : '');


			// isset la ham kiem tra xem co ton tai hay khong 
			// !empty kiem tar xem no o rong hay khong 

			// $payload['album'] = json_encode($payload['album']);// de lay tat ca abuml anh gom vao dang json
			// dd($payload);

			
			$payload['user_id']=Auth::id();
		

				$post=$this->postRepository->create($payload);
				

				if($post->id > 0){
					$payloadLanguage = $request->only($this->payloadLanguage());
					// payloadLanguage lay nhung gia tri can thiet co trong function private function payloadLanguage()
					$payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);

					$payloadLanguage['language_id']=$this->currentLanguage();
					$payloadLanguage['post_id'] = $post->id;

					// dd($payloadLanguage);
				$language =$this->postRepository->createPivot($post,$payloadLanguage,'Languages');


				$catalogue = $this->catalogue($request);
				$post->post_catalogues()->sync($catalogue);

				// dd($catalogue);
				//createLanguagePivot lay o phan baserepository
				// $postCataloguepost = $this->catalogue($post->id, $request->input('catalogue'));

    //    // dd($postCataloguepost);
				// // dong nay de tao moi quan he giua hai doi tuong 
				// $relation = $this->postRepository->createpPivot($post,$postCataloguepost,'$post,$postCataloguepost','post_catalogues');
				// // dd($relation);
			




				}
				
					DB::commit();// nghia la insert vao database
			return true;

		}catch(\Exception $e){
			DB::rollBack();// neu khong thanh cong thi quay lai trang cua minh 
			echo $e->getMessage();die();
			return false;
		}
	}
	// update
	public function update($id, $request)
{
    // Bắt đầu một giao dịch cơ sở dữ liệu
    DB::beginTransaction();

    try {
        // Lấy thông tin của bản ghi từ repository bằng ID
        $post= $this->postRepository->findById($id);
        // dd($postCatalogue);

        // Lấy các trường dữ liệu từ request theo các trường được định nghĩa trong phương thức payload()
        $payload = $request->only($this->payload());

        // Thêm trường user_id vào dữ liệu cập nhật và gán giá trị từ Auth::id()
        $payload['user_id'] = Auth::id();
        	$payload['album'] = (isset($payload['album'] ) && !empty($payload['album']) ? json_encode($payload['album']) : '');

        // Gọi phương thức update từ repository để cập nhật bản ghi
        $flag = $this->postRepository->update($id, $payload);

        // Nếu cập nhật thành công
        if ($flag == true) {
           $payloadLanguage = $request->only($this->payloadLanguage());
					// payloadLanguage lay nhung gia tri can thiet co trong function private function payloadLanguage()
					$payloadLanguage['canonical'] = Str::slug($payloadLanguage['canonical']);

					$payloadLanguage['language_id']=$this->currentLanguage();
					$payloadLanguage['post_id'] = $post->id;

            // Gỡ bỏ mọi liên kết ngôn ngữ cũ và thêm mới liên kết ngôn ngữ mới
					// detach la go bo di cai cu hay la lien ket cu sau do mk cap nhat ban khac vao sau khi sua doi 
            $post->languages()->detach([$payloadLanguage['language_id'], $id]);

            //tao mot lien ket moi  hay mot cap nhat moi 
            $response = $this->postRepository->createPivot($post, $payloadLanguage,'languages');

            
				$catalogue = $this->catalogue($request);


				$post->post_catalogues()->sync($catalogue);
				//$post->post_catalogues()->sync($catalogue);: Đây là một phương thức của Eloquent được gọi trên đối tượng Post. Phương thức post_catalogues() là mối quan hệ many-to-many giữa model Post và model PostCatalogue, và sync() được sử dụng để đồng bộ hóa các mục trong mối quan hệ với các giá trị mới được cung cấp
        }

        // Commit giao dịch cơ sở dữ liệu nếu mọi thứ thành công
        DB::commit();

        // Trả về true để thông báo rằng cập nhật thành công
        return true;

    } catch (\Exception $e) {
        // Nếu có lỗi, rollback giao dịch cơ sở dữ liệu và ghi log lỗi
        DB::rollBack();
        Log::error($e);

        // Trả về false để thông báo rằng có lỗi xảy ra
        return false;
    }
}
 private function uploadPost($id ,$request){
 	 $payload = $request->only($this->payload());
 	 $payload['album'] = (isset($payload['album'] ) && !empty($payload['album']) ? json_encode($payload['album']) : '');

 }
public function updateStatus($post = [])
{


    DB::beginTransaction();

    try {
        $payload = [];
        $payload[$post['field']] = ($post['value'] == 1) ? 2: 1; // Click vào dạng từ 0 sẽ chuyển thành 1 và ngược lại từ 1 sẽ thành 0

        $user = $this->postRepository->update($post['modelId'], $payload);
        // $this->changeUserStatus($post,$payload[$post['field']]);

        DB::commit();

        return true; // hoặc trả về một phản hồi cho biết thành công

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e->getMessage()); // Đăng nhập lỗi để phân tích sau này
        return false; // hoặc trả về một phản hồi cho biết thất bại
    }
}
//phan nay lam ve nhieu nut kich hoat cung mot luc 
public function updateStatusAll($post) {
    DB::beginTransaction();

    try {
        // Kiểm tra dữ liệu đầu vào
        if (empty($post['field']) || !isset($post['value']) || empty($post['id'])) {
            // Xử lý trường hợp không hợp lệ
            return false;
        }

        // Thiết lập giá trị mặc định cho $payload
        $payload = $payload ?? [];
        $payload[$post['field']] = $post['value'];
           // $this->changeUserStatus($post['id'],$post['value']);

        // Thực hiện cập nhật và kiểm tra kết quả
        $flag = $this->postRepository->updateByWhereIn('id', $post['id'], $payload);

        if ($flag) {
            // Thành công
            DB::commit();
            return true;
        } else {
            // Xử lý lỗi
            DB::rollBack();
            return false;
        }
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e->getMessage());
        return false;
    }
}

// phan nay van lam ve nut puslish
// private function changeUserStatus($post,$value)
// {
//     DB::beginTransaction();

//     try {
//     	$array=[];
//         if (isset($post['modeId'])) {
//             $array[] = $post['modelId'];
//         } else {
//             $array[] = $post['id'];
//         }

//         // Thiết lập giá trị mặc định cho $payload
//         $payload[$post['field']] = $value;

//         //$payload thường được sử dụng để chứa dữ liệu mà bạn muốn truyền vào một phương thức hoặc lớp khác để thực hiện các hành động như cập nhật cơ sở dữ liệu.
//         //$payload[$post['field']] = $value; là để chuẩn bị dữ liệu mà bạn muốn cập nhật hoặc chuyển đ

//         // Thực hiện cập nhật và kiểm tra kết quả
//         $flag = $this->userCatalogueRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
//         // cau nay la tat ca user_catalogue_id nam trong mang array va update thanh $payload 
//         dd($payload);

//         if ($flag) {
//             // Thành công
//             DB::commit();
//             return true;
//         } else {
//             // Xử lý lỗi
//             DB::rollBack();
//             return false;
//         }
//     } catch (\Exception $e) {
//         DB::rollBack();
//         Log::error($e->getMessage());
//         return false;
//     }
// }


		


// 	// xoa 
public function destroy($id){
    DB::beginTransaction();

    try {
       $post = $this->postRepository->delete($id);

   


       
            DB::commit();
            return true;
     
      
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e);
        return false;
    }
}
}