<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Models\UserCatalogue;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;// day la thu vien de thiet lap date
use Illuminate\Support\Facades\Hash;//de // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu






/**
 * Class userCatalogueService
 * @package App\Services
 */
class UserCatalogueService implements  UserCatalogueServiceInterface
{
	protected $userCatalogueRepository;
	protected $userRepository;
	public function __construct(UserCatalogueRepository $userCatalogueRepository,UserRepository $userRepository){
				$this->userCatalogueRepository=$userCatalogueRepository;
				$this->userRepository=$userRepository;



	}
	private function select(){
		return[
			'id',
			'name',
			'description',
			'publish'
			
		];


	}
	public function paginate($request){

//$relation tao moi quan he cho cac bnag trong du lieu 
	

		$condition['keyword'] = addslashes($request->input('keyword'));

		//addslashes() là một hàm trong PHP được sử dụng để thêm dấu gạch chéo (\) vào trước các ký tự đặc biệt như dấu nháy đơn (')
		$condition['publish'] = $request->integer('publish');
		// dd($condition);
		$perpage=$request->integer('perpage');
		
		// truyen thuoc tinh va muon cho du lieu vao 
		$userCatalogues=$this->userCatalogueRepository->pagination($this->Select(),$condition,[],['path'=>'user/catalogue/index'],$perpage,['users']);
	
		
		return $userCatalogues;



 	}
	public function create($request){
		DB::beginTransaction();// tao ra mot  secssion
		try{
			// $payload=$request->input();
				$payload=$request->except(['_token','send']);//except nghia la lya tat ca ngoai tru cai gi do mk viet ben trong ham 

			
		

				$user=$this->userCatalogueRepository->create($payload);
				// dd($user);
					DB::commit();// nghia la insert vao database
			return true;

		}catch(\Exception $e){
			DB::rollBack();// neu khong thanh cong thi quay lai trang cua minh 
			echo $e->getMessage();die();
			return false;
		}
	}
	// update
	public function update($id,$request){
		DB::beginTransaction();

			try {
			    // $user = $this->userCatalogueRepository->findById($id);

			    $payload = $request->except(['_token', 'send']);
			   


			

			    $user = $this->userCatalogueRepository->update($id,$payload);

			    DB::commit();
			    
			    return true; // hoặc trả về một phản hồi cho biết thành công

			} catch (\Exception $e) {
			    DB::rollBack();
			    Log::error($e); // Đăng nhập lỗi để phân tích sau này
			    return false; // hoặc trả về một phản hồi cho biết thất bại
			}
		}

		// phan nay la lam ve nut kich hoat 
public function updateStatus($post = [])
{


    DB::beginTransaction();

    try {
        $payload = [];
        $payload[$post['field']] = ($post['value'] == 1) ? 2: 1; // Click vào dạng từ 0 sẽ chuyển thành 1 và ngược lại từ 1 sẽ thành 0

        $user = $this->userCatalogueRepository->update($post['modelId'], $payload);
        $this->changeUserStatus($post,$payload[$post['field']]);

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
           $this->changeUserStatus($post['id'],$post['value']);

        // Thực hiện cập nhật và kiểm tra kết quả
        $flag = $this->userCatalogueRepository->updateByWhereIn('id', $post['id'], $payload);

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
private function changeUserStatus($post,$value)
{
    DB::beginTransaction();

    try {
    	$array=[];
        if (isset($post['modeId'])) {
            $array[] = $post['modelId'];
        } else {
            $array[] = $post['id'];
        }

        // Thiết lập giá trị mặc định cho $payload
        $payload[$post['field']] = $value;

        //$payload thường được sử dụng để chứa dữ liệu mà bạn muốn truyền vào một phương thức hoặc lớp khác để thực hiện các hành động như cập nhật cơ sở dữ liệu.
        //$payload[$post['field']] = $value; là để chuẩn bị dữ liệu mà bạn muốn cập nhật hoặc chuyển đ

        // Thực hiện cập nhật và kiểm tra kết quả
        $flag = $this->userCatalogueRepository->updateByWhereIn('user_catalogue_id', $array, $payload);
        // cau nay la tat ca user_catalogue_id nam trong mang array va update thanh $payload 
        dd($payload);

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


		

	
	// xoa 
public function destroy($id){
    DB::beginTransaction();

    try {
       $user = $this->userCatalogueRepository->delete($id);


       
            DB::commit();
            return true;
     
      
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e);
        return false;
    }
}
}



	


