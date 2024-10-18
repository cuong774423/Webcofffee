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
            // Xóa cột LastUpdated
            $table->dropColumn('LastUpdated');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory', function (Blueprint $table) {
            // Thêm lại cột LastUpdated nếu cần
            $table->date('LastUpdated')->nullable(); // Thêm nullable nếu bạn muốn
        });
    }
};
