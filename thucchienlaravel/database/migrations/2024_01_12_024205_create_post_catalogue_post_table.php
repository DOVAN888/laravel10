<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('post_catalogue_post', function (Blueprint $table) {
        // Thay vì unsignedBingInteger, bạn nên sử dụng unsignedBigInteger
//         $table->unsignedBigInteger('post_catalogue_id');
//         $table->unsignedBigInteger('post_id');

//         // Thêm foreign key constraints để liên kết với bảng post_catalogues và posts
//         $table->foreign('post_catalogue_id')->references('id')->on('post_catalogues')->onDelete('cascade');
//         $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

//         $table->timestamps();
//     });
// }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_catalogue_posts');
    }
};

//onDelete('cascade'): Thêm onDelete('cascade') để đảm bảo rằng nếu một bản ghi trong bảng cha ('post_catalogues' hoặc 'posts') bị xóa, thì các bản ghi tương ứng trong bảng con ('post_catalogue_post') cũng sẽ bị xóa (cascade delete). Điều này giúp duy trì tính toàn vẹn referential integrity trong cơ sở dữ liệu.
//unsignedBigInteger để định nghĩa một cột số nguyên không dấu với độ rộng đủ lớn để chứa ID của các bảng liên quan.
//constraints la su rang buoc