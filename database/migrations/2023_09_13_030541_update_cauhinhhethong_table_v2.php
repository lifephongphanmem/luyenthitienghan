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
        Schema::table('cauhinhhethong', function (Blueprint $table) {
            $table->string('macauhinh',50)->nullable();
            $table->string('machucnang',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cauhinhhethong', function (Blueprint $table) {
            $table->dropColumn('macauhinh');
            $table->dropColumn('machucnang');
        });
    }
};
