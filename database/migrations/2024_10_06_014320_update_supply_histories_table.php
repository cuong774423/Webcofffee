<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('supply_histories', function (Blueprint $table) {
            // Xóa khóa ngoại và cột `OrderID`
            $table->dropForeign(['OrderID']);
            $table->dropColumn('OrderID');

            // Thêm cột mới `WarehouseInEmployeeID` liên kết với bảng `employees`
            $table->foreignId('WarehouseInEmployeeID')->constrained('employees', 'EmployeeID')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supply_histories', function (Blueprint $table) {
            // Khôi phục lại cột `OrderID` nếu cần rollback
            $table->foreignId('OrderID')->constrained('orders', 'OrderID')->onDelete('cascade');

            // Xóa cột `WarehouseInEmployeeID`
            $table->dropForeign(['WarehouseInEmployeeID']);
            $table->dropColumn('WarehouseInEmployeeID');
        });
    }
};
