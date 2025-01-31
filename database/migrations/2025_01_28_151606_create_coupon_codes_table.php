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
        Schema::create('coupon_codes', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_name', 191);
            $table->string('coupon_code', 191)->unique();
            $table->decimal('percentage', 5, 2);
            $table->decimal('discount_cap', 10, 2)->nullable();
            $table->integer('max_use')->nullable();
            $table->integer('use_per_customer')->nullable();
            $table->date('start_date');
            $table->date('expired_date');
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->softDeletes(); // For soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_codes');
        
    }
};
