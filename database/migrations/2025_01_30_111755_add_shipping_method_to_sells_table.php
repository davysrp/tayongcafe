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
        Schema::table('sells', function (Blueprint $table) {
            $table->unsignedBigInteger('shipping_method_id')->nullable()->after('coupon_code_id');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods')->onDelete('set null');
            $table->text('remark')->nullable()->after('shipping_method_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sells', function (Blueprint $table) {
            //
            $table->dropForeign(['shipping_method_id']);
            $table->dropColumn(['shipping_method_id', 'remark']);
        });
    }
};
