<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateGenderColumnInCustomersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Thay đổi cột gender
        Schema::table('customers', function (Blueprint $table) {
            // Xóa cột gender cũ
            $table->dropColumn('gender');
            // Thêm cột gender mới với giá trị 'Nam', 'Nữ', 'Khác'
            $table->enum('gender', ['Nam', 'Nữ', 'Khác'])->nullable(); // Có thể để null nếu muốn
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Hoàn nguyên lại cột gender cũ
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->enum('gender', ['male', 'female', 'other'])->nullable(); // Trả lại cột cũ nếu cần
        });
    }
}
