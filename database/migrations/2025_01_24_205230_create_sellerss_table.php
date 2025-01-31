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
        Schema::create('sellerss', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Seller's name
            $table->string('email')->unique(); // Seller's email
            $table->string('phone')->nullable(); // Seller's phone number
            $table->string('address')->nullable(); // Seller's address
            $table->timestamps(); // Created at and updated at timestamps
            $table->softDeletes(); // Soft delete column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellerss');
    }
};
