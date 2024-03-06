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
         Schema::create('users', function (Blueprint $table) {
            $table->id();// tu dong tao khoa chinh 
            $table->string('name')->nullable();
         
             
              $table->text('description')->nullable();
              $table->timestamp('deleted_at')->nullable();
               $table->tinyInteger('publish')->default(0);

         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_catalogues');
    }
};
