<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{ 
    public function __construct(){
        
    }
    //admin
    public function index(){

      
      
        return view('backend.auth.login');
   
   
    } 

    public function login(AuthRequest $request){
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ];


    $user = User::where('email', $credentials['email'])->first();

    if ($user && $credentials['password'] === $user->password) {
        auth()->login($user);// ham nay duoc laravel cung cap
        return redirect()->route('dashboad.index')->with('success', 'Đăng nhập thành công');
    }

    return redirect()->route('auth.admin')->with('error', 'Email hoặc mật khẩu không chính xác');
}


    // day la cach 2 khi dung auth bycry bam mat khau
    //di den trang dasboad
    // public function login(AuthRequest $request){
    //     $credentials = [
    //         'email' => $request->input('email'),
    //         'password' => $request->input('password')
    //     ];

    //     if(Auth::attempt($credentials)){
    //        return redirect()->route('dashboad.index')->with('success','dang nhap thanh cong');
    //        //Auth::attempt de xac thuc nguoi dung 
    //     }
    //     dd('Đăng nhập thất bại'); 

    //     return redirect()->route('auth.admin')->with('error','Email  hoac mat khau khong chinh xac ');
    // }



    //logout
    public function logout(Request $request){
    Auth::logout(); // Đăng xuất người dùng

    $request->session()->invalidate(); // Đảm bảo phiên kết thúc và không hoạt động nữa
    $request->session()->regenerateToken(); // Đảm bảo tạo một token mới và token cũ sẽ hết hạn

    return redirect()->route('auth.admin'); // Chuyển hướng người dùng đến trang cụ thể sau khi đăng xuất
}

}
