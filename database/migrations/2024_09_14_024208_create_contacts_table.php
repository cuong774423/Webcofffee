<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->string('name'); // Tên khách hàng
            $table->string('email'); // Email khách hàng
            $table->string('phone')->nullable(); // Số điện thoại khách hàng
            $table->text('message'); // Tin nhắn liên hệ
            $table->boolean('is_replied')->default(false); // Trạng thái đã phản hồi hay chưa
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
