<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id(); // Trường id, tự động tăng
            $table->string('name'); // Tên khách hàng
            $table->enum('gender', ['male', 'female', 'other']); // Giới tính
            $table->string('email')->unique(); // Email, không được trùng lặp
            $table->string('address')->nullable(); // Địa chỉ
            $table->string('phone_number')->nullable(); // Số điện thoại
            $table->text('note')->nullable(); // Ghi chú
            $table->timestamps(); // Các trường created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
}
