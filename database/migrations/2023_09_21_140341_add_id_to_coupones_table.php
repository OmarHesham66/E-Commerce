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
        Schema::table('users_order', function (Blueprint $table) {
            $table->foreignId('coupone_id')->after('payment_method')->references('id')->on('coupones');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users_order', function (Blueprint $table) {
            $table->dropColumn('coupone_id');
        });
    }
};
