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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('ReviewID');
            $table->foreignId('ProductID')->constrained('products', 'ProductID');
            $table->foreignId('UserID')->constrained('users', 'UserID');
            $table->integer('Rating')->default(5);
            $table->text('Comment')->nullable();
            $table->date('ReviewDate');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
