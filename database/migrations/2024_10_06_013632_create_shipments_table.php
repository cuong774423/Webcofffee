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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id('ShipmentID');
            $table->foreignId('ProductID')->constrained('products', 'ProductID');
            $table->integer('Quantity');  // Số lượng hàng xuất
            $table->date('ShipmentDate');  // Ngày xuất hàng
            $table->text('Notes')->nullable();  // Ghi chú (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
