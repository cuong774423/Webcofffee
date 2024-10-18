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
        Schema::table('shipments', function (Blueprint $table) {
            // Thêm cột WarehouseOutEmployeeID, liên kết với bảng employees
            $table->foreignId('WarehouseOutEmployeeID')->nullable()->constrained('employees', 'EmployeeID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            // Xóa cột WarehouseOutEmployeeID
            $table->dropConstrainedForeignId('WarehouseOutEmployeeID');
        });
    }
};
