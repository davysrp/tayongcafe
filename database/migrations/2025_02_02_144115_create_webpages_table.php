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
        Schema::create('webpages', function (Blueprint $table) {
            $table->id();
            $table->string('names'); // Column for webpage name
            $table->text('detail'); // Column for webpage details
            $table->string('image')->nullable(); // Column for image path
            $table->boolean('status')->default(1); // Active or Inactive
            $table->timestamps();
            $table->softDeletes(); // Enable soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webpages');
    }
};

