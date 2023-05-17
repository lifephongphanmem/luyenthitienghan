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
            $table->integer('dangcaudochieu')->nullable();
            $table->integer('dangcauxemtranh')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cauhoi', function (Blueprint $table) {
            $table->dropColumn('dangcaudochieu');
            $table->dropColumn('dangcauxemtranh');
        });
    }
};
