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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50)->comment('Customer\'s first name');
            $table->string('last_name', 50)->comment('Customer\'s last name');
            $table->string('email', 100)->unique()->comment('Customer\'s email address');
            $table->string('phone_number', 15)->nullable()->comment('Customer\'s phone number');
            $table->timestamps();
            $table->softDeletes(); // Optional: for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
