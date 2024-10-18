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
        Schema::table('inventory', function (Blueprint $table) {
            $table->foreignId('SupplierID')->constrained('suppliers', 'SupplierID')->after('ProductID'); // Thêm cột SupplierID
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropForeign(['SupplierID']); // Xóa ràng buộc khóa ngoại
            $table->dropColumn('SupplierID'); // Xóa cột SupplierID
        });
    }
};