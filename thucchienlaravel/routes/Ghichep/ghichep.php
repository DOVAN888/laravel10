<?php
1,$users = DB::table('users')->get();//lay tat ca table user
2,$user = DB::table('users')->where('name', 'John')->first();
//Nếu bạn chỉ cần truy xuất một hàng từ bảng cơ sở dữ liệu, bạn có thể sử dụng phương thức first. Phương thức này sẽ trả về

3:$email = DB::table('users')->where('name', 'John')->value('email');
//Nếu bạn không cần toàn bộ dữ liệu trên một hàng, bạn có thể trích xuất một giá trị từ một bản ghi bằng cách dùng phương
//thức value. Phương thức này sẽ trả về giá trị của cột tương ứng:

4:$user = DB::table('users')->find(3);
//Để truy xuất một hàng theo giá trị của cột id bạn hãy sử dụng phương thức find: ben trong id la gia tri cua  id la bao nhieu 

5:$titles = DB::table('users')->pluck('title');
//de truy xuất các giá trị của một cột, bạn có thể sử dụng phương thức pluck:

6:$titles = DB::table('users')->pluck('title', 'name');//Bạn có thể chỉ định cột mà tập kết quả sẽ sử dụng làm khóa (key) của nó bằng cách cung cấp đối số thứ hai cho phương
//thức pluck:
7:DB::table('users')->orderBy('id')->chunk(100, function ($users) {
foreach ($users as $user) {
//
}
});

//Nếu bạn cần làm việc với hàng nghìn bản ghi cơ sở dữ liệu, hãy xem xét sử dụng phương thức chunk. chunk sẽ truy xuất một
//phần nhỏ kết quả tại một thời điểm và đưa mỗi phần vào closure (hàm callback) để xử lý. Ví dụ sau đây truy xuất toàn bộ dữ
//liệu của bảng users nhưng với 100 bản ghi tại một thời điểm:


6:
$users = DB::table('users')->distinct()->get();
//Phương thức distinct cho phép bạn chỉ lấy một kết quả trong các kết quả giống nhau:

7:$query = DB::table('users')->select('name');
$users = $query->addSelect('age')->get();
//Nếu bạn đã có một query builder rồi và bạn muốn thêm một cột vào kết quả thì bạn có thể sử dụng phương thức addSelect:

8: 
$users = DB::table('users')
             ->where('name', '=', 'John')
             ->where('status', '=', 1)
             ->get();
//where thi de thuc hien dieu kien binh thuong 

9:$users = DB::table('users')
             ->whereRaw('name = ? AND status = ?', ['John', 1])
             ->get();
  //Phương thức whereRaw được sử dụng khi bạn muốn chèn một điều kiện SQL raw vào truy vấn mà không cần chuẩn bị giá trị.

  10:
$users = DB::table('users')->distinct()->get();
//Phương thức distinct cho phép bạn chỉ lấy một kết quả trong các kết quả giống nhau:

?>