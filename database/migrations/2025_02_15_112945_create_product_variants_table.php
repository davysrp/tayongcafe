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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('product_id'); // Foreign key to products table
            $table->string('variant_code'); // Variant code (e.g., "COLOR-RED")
            $table->string('variant_name'); // Variant name (e.g., "Red")
            $table->decimal('variant_price', 8, 2); // Variant price
            $table->boolean('status')->default(true); // Variant status (active/inactive)
            $table->string('variant_size')->nullable(); // Variant size (optional)
            $table->timestamps(); // Created at and updated at timestamps

            // Define foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
