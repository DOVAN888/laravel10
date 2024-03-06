
Phan1:database 
1,comppser -v de kiem tra version 
php artisan migrate:reset de chay lai migarate 
php artisan db:seed de chay dong lenh seedd de ket noi database  vi thang seed da lay du lieu ao o factory de insert vao database 
3,エクスポート de lay du lieu trong sql tao ra mot file、インポート lay du lieu tu file cho vao mysql 


phan2:controller
1,xac thuc login can phai validate  de xac thuc nguoi dung 
neu chua dang nhap se xuat ra loi 
2,de guui len thi phai co Request $request 
3 <div> $user=User::all();</div> // de goi tat ca user tu trong atabase

4, // $users=User::all();// lay tat ca du lieu trong database 
        $users = User::paginate(15);// no se show ra 15 ban ghi trong 1 trang

 5,λ php artisan make:migration add_user_catalogue_id_to_users --table=users day la canh them mot cot vao data       




phan3 modell



phan4 view
1,Route::post('login',[AuthController::class,'login'])->name('auth.login');
->name('auth.login'); de goi sang phan action trong phan form ben trang view
2,APP_URL=http://vantuongcongnghe.com:8000/
    <base href=" {{env('APP_URL')}}"> de khop duong dan 
 3, value="{{old('email')}}" de giu lai bieu mau khi mk nhap 
 4,compact('temblate') duoc ghi o controller va nhu the o view se su dung de inclue bien nay duoc 
 4compact('template','config','users')) ben trang view se goi nhung gi co trong thang compactt 

 5,lable la de cho dong tren nam sat voi dong ben duoi mot khoang cach gan nhat
 6,autocomplete="off" no se khong goi y hoac hien ra thong tin nguoi dung da hap truoc do trong the input

 7,tac dung cua cac class trong bootrap 

Dưới đây là một số class phổ biến trong Bootstrap và mô tả về chúng:

Grid System:

.container: Tạo một container để giữ nội dung.
.row: Tạo một hàng trong grid.
.col-<size>: Đặt kích thước cột, ví dụ: .col-md-6 để tạo cột chiếm 1/2 width trên màn hình có độ rộng trung bình.
Typography:

.h1 đến .h6: Định dạng kích thước tiêu đề.
.lead: Tăng kích thước và độ nhấn của văn bản.
Colors:

.text-primary, .text-success, ...: Đặt màu văn bản theo màu chủ đạo hoặc theo ý muốn.
Background Colors:

.bg-primary, .bg-success, ...: Đặt màu nền theo màu chủ đạo hoặc theo ý muốn.
Spacing:

.m-1, .p-2: Đặt margin hoặc padding với các giá trị từ 0 đến 5.
.mx-auto: Canh giữa theo chiều ngang.
Borders:

.border, .border-top, ...: Thêm đường viền vào phần tử.
.rounded: Làm tròn góc của phần tử.
Buttons:

.btn: Tạo một nút.
.btn-primary, .btn-secondary, ...: Đặt màu cho nút.
Forms:

.form-control: Thiết lập kiểu cho trường nhập liệu.
.form-group: Nhóm các trường liên quan.
Alerts:

.alert: Tạo một hộp thông báo.
.alert-success, .alert-info, ...: Đặt màu cho hộp thông báo.
Navbar:

.navbar: Tạo một thanh điều hướng.
.navbar-brand: Định dạng logo hoặc tên thương hiệu. 
.navbar-nav: Container cho các mục thanh điều hướng.

4, thangnam trong value chinh la code la id 



5,hien thi hinh anh 
-composer require intervention/image




phan5 route



phan6:
1,loi 419 chinh la loi tocken 

phan7 cai dat 


phan 8 timkiem 
1, tim kiem phan toast, de dua ra thong bao loi su dung cau lenh nay de cai dat: composer require yoeunes/toastr

2,tim kiem phan vadition 
3, php artisan make:seeder UserSeeder
4,php artisan make:factory UserFactory
5, php artisan db:seed



phan9:boottrap 
1<a href="" class="btn btn-success"><i class="fa fa-edit"></i></a>//phan nay la thanh cong se hien mau xanh 
<a href="" class="btn btn-danger"><i class="fa fa-trash"></i></a>//phan nay that bai phan  tu se hien mau do 
  <th class="text-center">Tinh trang</th>// pahan nay de can giua 
hay chu y den class 


phan10:chu y
1tao file factory de thiet lap co du lieu ao khi chay ma khong can goi truc tiep trong co so du lieu lieu ,de tao 
ra co so du lieu ao va tao ra cac ban ghi ao tu dong 
2 de chay factory thi ta phai vao file database va tao mot seeder sau do import model vao va goi thang factory vao day vi du \App\Models\User::factory(1)->create();
3 canh goi nhu sau factory->UserSeeder(trong nay phai import thang model vao )->DatabaseSeeder.

phan 11 middlewe 
1 de xac thuc nguoi dung khong the nhap ten truc tiep vao duong link khi chua dang nhap 
vd:    */<?php
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::id()==null){
             return redirect()->route('auth.admin')->with('error','ban phai dang nhap de su dung ');
        }
        return $next($request);
    }

    2,<?


    phan 12: services
    1, composer require getsolaris/laravel-make-service --dev   cau nay de cai dt service 
    2, tao service :php artisan make:service UserService --i khi ghi them i no se tao them model cho ban
    3,composer dump-autoload
    4,php artisan migrate --path=/database/migrations/2023_12_07_060139_create_post_catalogues_table.php
    4.1,php artisan migrate:rollback --path=/database/migrations/2023_12_07_044035_create_languages_table.php
    5,php artisan migrate:rollback
    6, php artisan make:migration rename_post_catalogue_translate_to_post_language --table=post_catalogue_translate
    7,php artisan config:cache de chay app/user
    8,php artisan route:cache






phan 12:composer
php artisan config:cache de chay app/user





13,cach truy van co so du lieu7

- $provinces = $this->provinceRepository->all(); goi tat cadu lieu 
-DB::beginTransaction();// de tao ra mot session 


-use Illuminate\Support\Carbon; thu vien de lap trinh ngay 











14 chu y
-cac phan dang bi bo qua phan tu dong luu lai phuong xa quan huyen va phuong 
-va phan xu ly anh trong form user 

15 composer chay 
 1 composer de cap nhat tring tai tu dong: composer dump-autoload
 2 Lệnh php artisan config:cache trong Laravel được sử dụng để tạo một bản sao đóng (caching) của tất cả các file cấu hình trong ứng dụng Laravel của bạn vào một tệp duy nhất để cải thiện hiệu suất.
3  php artisan tinker de viet truc tiep vao cmd





hom nay hco den 1h9p 