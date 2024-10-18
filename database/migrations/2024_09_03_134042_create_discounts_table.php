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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id('DiscountID');
            $table->string('DiscountCode')->unique();
            $table->text('Description')->nullable();
            $table->decimal('DiscountAmount', 8, 2);
            $table->date('StartDate');
            $table->date('EndDate');
            $table->foreignId('ProductID')->nullable()->constrained('products', 'ProductID');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discounts');
    }
};
