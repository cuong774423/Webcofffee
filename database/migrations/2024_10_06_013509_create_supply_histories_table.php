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
        Schema::create('supply_histories', function (Blueprint $table) {
            $table->id('SupplyID');
            $table->foreignId('SupplierID')->constrained('suppliers', 'SupplierID');
            $table->foreignId('OrderID')->constrained('orders', 'OrderID');
            $table->foreignId('ProductID')->constrained('products', 'ProductID');
            $table->integer('Quantity');
            $table->date('DeliveryDate');
            $table->enum('Status', ['Delivered', 'Pending', 'Delayed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_histories');
    }
};
