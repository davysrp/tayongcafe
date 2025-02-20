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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // This creates an unsigned big integer primary key column
            $table->string('names');
            $table->unsignedBigInteger('category_id');
            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);
            $table->text('detail')->nullable();
            $table->string('photo')->nullable();
            $table->integer('day_warranty')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->string('sku')->nullable();
            $table->integer('product_number')->default(0);

            // Foreign key to categories table
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // Foreign key to sellers table (if applicable)
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
