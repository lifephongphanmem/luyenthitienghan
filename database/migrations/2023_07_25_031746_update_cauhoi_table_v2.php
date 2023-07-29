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
        Schema::table('cauhoi', function (Blueprint $table) {
            $table->string('hoithoai1')->nullable();
            $table->string('hoithoai2')->nullable();
            $table->string('hoithoai3')->nullable();
            $table->string('hoithoai4')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cauhoi', function (Blueprint $table) {
            $table->dropColumn('hoithoai1');
            $table->dropColumn('hoithoai2');
            $table->dropColumn('hoithoai3');
            $table->dropColumn('hoithoai4');
        });
    }
};
