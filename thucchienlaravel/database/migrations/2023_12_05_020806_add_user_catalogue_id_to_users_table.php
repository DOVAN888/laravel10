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
        // Thêm cột user_catalogue_id vào bảng users
        Schema::table('users', function (Blueprint $table) {
            $table->Integer('user_catalogue_id')->unsigned()->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa ràng buộc khóa ngoại và cột user_catalogue_id
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['user_catalogue_id']);
            $table->dropColumn('user_catalogue_id');
        });
    }
};

