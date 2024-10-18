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
        Schema::table('employees', function (Blueprint $table) {
            $table->enum('Role', ['Manager', 'Sales', 'Barista', 'WarehouseIn', 'WarehouseOut'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            // Quay về giá trị cũ nếu rollback
            $table->enum('Role', ['Manager', 'Sales', 'Barista'])->change();
        });
    }
};
