<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;// day la thu vien de thiet lap date
use Illuminate\Support\Facades\Hash;//de // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu






/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
	protected $userRepository;
	public function __construct(UserRepository $userRepository){
				$this->userRepository=$userRepository;


	}
	private function select(){
		// day la nhung id duoc chon ra banj muon them gia tri nao thi lay tu database cho vao day 
		return[
			'id',
			'name'
			,'email'
			,'phone'
			,'address'
			,'publish'
			,'user_catalogue_id'
			,'image'


		];


	}
	public function paginate($request){
		$condition['keyword'] = addslashes($request->input('keyword'));
		$condition['publish'] = $request->integer('publish');
		// dd($condition);
		$perpage=$request->integer('perpage');
		
		// truyen thuoc tinh va muon cho du lieu vao 
		$users=$this->userRepository->pagination($this->select(),$condition,[],	['path'=>'user/index'],$perpage);
	
		
		return $users;




	}
	public function create($request){
		DB::beginTransaction();// tao ra mot  secssion
		try{
			// $payload=$request->input();
				$payload=$request->except(['_token','send','re_password',]);//except nghia la lya tat ca ngoai tru cai gi do mk viet ben trong ham 

			
				//dinh dang cho birday 
				$payload['birthday'] = $this-> convertBirthdayDate($payload['birthday']);
				$payload['password'] = Hash::make($payload['password']);// cai nay de ma hoa password
				
				// dd($payload);

				$user=$this->userRepository->create($payload);
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
			    // $user = $this->userRepository->findById($id);

			    $payload = $request->except(['_token', 'send']);
			   


			    // Định dạng ngày sinh
			    $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
			    
			    // Băm mật khẩu
			
			    // dd($payload);

			    $user = $this->userRepository->update($id,$payload);
			    // update theo id nen phai co gia tri id 

			    DB::commit();//commit vao co so du lieu 
			    
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
        $payload[$post['field']] = ($post['value'] == 2) ? 1 : 2; // Click vào dạng từ 1 sẽ chuyển thành 2 và ngược lại từ 2 sẽ thành 1

        $user = $this->userRepository->update($post['modelId'], $payload);

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

        // Thực hiện cập nhật và kiểm tra kết quả
        $flag = $this->userRepository->updateByWhereIn('id', $post['id'], $payload);

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


		

	private function convertBirthdayDate($birthday = ''){
		$carbondate = Carbon::createFromFormat('Y-m-d',$birthday);
		$birthday=$carbondate->format('Y-m-d H:i:s');
		return $birthday;
	}
	// xoa 
public function destroy($id){
    DB::beginTransaction();

    try {
       $user = $this->userRepository->delete($id);


       
            DB::commit();
            return true;
     
      
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error($e);
        return false;
    }
}
//paginate
}



	


