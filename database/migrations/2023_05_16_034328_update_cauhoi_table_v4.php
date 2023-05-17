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
            $table->integer('dangcau')->nullable();
            $table->string('macaughep')->nullable();
            $table->string('hoithoai')->nullable();
            $table->string('nguoi1')->nullable();
            $table->string('nguoi2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cauhoi', function (Blueprint $table) {
            $table->dropColumn('dangcau');
            $table->dropColumn('macaughep');
            $table->dropColumn('hoithoai');
            $table->dropColumn('nguoi1');
            $table->dropColumn('nguoi2');
        });
    }
};
