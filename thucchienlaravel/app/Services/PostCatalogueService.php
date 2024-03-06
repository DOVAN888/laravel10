<?php

namespace App\Services;

use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Services\BaseService;
use App\Models\PostCatalogue;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;// dlanguagen de thiet lap date
use Illuminate\Support\Facades\Hash;//de // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
use App\Classes\Nestedsetbie;






class PostCatalogueService extends BaseService implements  PostCatalogueServiceInterface
{
	protected $postCatalogueRepository;
	protected $nestedset;
	  protected $language;
	
	public function __construct(
		PostCatalogueRepository $postCatalogueRepository
		


	){
		$this->language = $this->currentLanguage();
				$this->postCatalogueRepository=$postCatalogueRepository;
				$this->nestedset = new Nestedsetbie([
					'table' =>'post_catalogues',
					'foreignkey'=>'post_catalogue_id',
					'language_id'=>$this->currentLanguage(),

				]);
		


	}
	private function select(){
		return[
	 'post_catalogues.id',
	
	 'post_catalogues.publish',
	 'post_catalogues.image',
	  'post_catalogues.level',
	  'post_catalogues.order',
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

	public function paginate($request){

//$relation tao moi quan he cho cac bnag trong du);
	

		$condition['keyword'] = addslashes($request->input('keyword'));

		//addslashes() là một hàm trong PHP được sử dụng để thêm dấu gạch chéo (\) vào trước các ký tự đặc biệt như dấu nháy đơn (')
		$condition['publish'] = $request->integer('publish');
			$condition['where'] = [
				'tb2.language_id','=',$this->language
			];

		// dd($condition);
		$perpage=$request->integer('perpage');
		
		// truyen thuoc tinh va muon cho du lieu vao 
		$postCatalogue=$this->postCatalogueRepository->pagination($this->Select(),
			$condition,
			[
				// doan nay join sang de lay id ben post_catalogue_language de lay ra danh sach 
				['post_catalogue_language as tb2','tb2.post_catalogue_id','=','post_catalogues.id']
			],
			['path'=>'post.catalogue.index'],
			$perpage,
			[],
			[
			'post_catalogues.lft','ASC',
		     ],
		);

	
		// dd($postCatalogue);
		return $postCatalogue;



 	}
	public function create($request){
		DB::beginTransaction();// tao ra mot  secssion
		try{
			// $payload=$request->input();
			
				//$payload=$request->except(['language_id']);//except nghia la lya tat ca ngoai tru cai gi do mk viet ben trong ham 
			$payload=$request->only($this->payload());
			// ham only chi lay nhung gia chi ma no yeu cau no nguoc voi ham except
			$payload['album'] = json_encode($payload['album']);// de lay tat ca abuml anh gom vao dang json
			// dd($payload);

			
			$payload['user_id']=Auth::id();
		

				$postCatalogue=$this->postCatalogueRepository->create($payload);
				

				if($postCatalogue->id > 0){
					$payloadLanguage = $request->only($this->payloadLanguage());

					$payloadLanguage['language_id']=$this->currentLanguage();
					$payloadLanguage['post_catalogue_id'] = $postCatalogue->id;

					
				$language =$this->postCatalogueRepository->createPivot($postCatalogue,$payloadLanguage,'languages');
				


			




				}
				$this->nestedset->Get('level ASC,order ASC');
				$this->nestedset->Recursive(0,$this->nestedset->Set());
				$this->nestedset->Action();

				// // dd($user);
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
        $postCatalogue = $this->postCatalogueRepository->findById($id);
        // dd($postCatalogue);

        // Lấy các trường dữ liệu từ request theo các trường được định nghĩa trong phương thức payload()
        $payload = $request->only($this->payload());

        // Thêm trường user_id vào dữ liệu cập nhật và gán giá trị từ Auth::id()
        $payload['user_id'] = Auth::id();
        	$payload['album'] = json_encode($payload['album']);

        // Gọi phương thức update từ repository để cập nhật bản ghi
        $flag = $this->postCatalogueRepository->update($id, $payload);

        // Nếu cập nhật thành công
        if ($flag == true) {
            // Lấy các trường dữ liệu ngôn ngữ từ request theo các trường được định nghĩa trong phương thức payloadLanguage()
            $payloadLanguage = $request->only($this->payloadLanguage());

            // Thêm trường language_id và post_catalogue_id vào dữ liệu ngôn ngữ
            $payloadLanguage['language_id'] = $this->currentLanguage();
            $payloadLanguage['post_catalogue_id'] = $id;

            // Gỡ bỏ mọi liên kết ngôn ngữ cũ và thêm mới liên kết ngôn ngữ mới
            $postCatalogue->languages()->detach([$payloadLanguage['language_id'], $id]);
            $response = $this->postCatalogueRepository->createPivot($postCatalogue, $payloadLanguage,'languages');

            // Sắp xếp lại cây đa cấp (nested set) sau khi cập nhật
            $this->nestedset->Get('level ASC, order ASC');
            $this->nestedset->Recursive(0, $this->nestedset->Set());
            $this->nestedset->Action();
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

		// phan nay la lam ve nut kich hoat 
public function updateStatus($post = [])
{


    DB::beginTransaction();

    try {
        $payload = [];
        $payload[$post['field']] = ($post['value'] == 1) ? 2: 1; // Click vào dạng từ 0 sẽ chuyển thành 1 và ngược lại từ 1 sẽ thành 0

        $user = $this->postCatalogueRepository->update($post['modelId'], $payload);
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
        $flag = $this->postCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);

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
       $postCatalogue = $this->postCatalogueRepository->delete($id);


            DB::commit();
            return true;
     
      
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e);
        return false;
    }
}
}