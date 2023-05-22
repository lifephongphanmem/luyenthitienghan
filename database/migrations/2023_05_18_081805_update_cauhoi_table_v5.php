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
            $table->text('noidungtiengviet')->nullable();
            $table->string('cauhoitiengviet')->nullable();
            $table->string('Atiengviet')->nullable();
            $table->string('Btiengviet')->nullable();
            $table->string('Ctiengviet')->nullable();
            $table->string('Dtiengviet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cauhoi', function (Blueprint $table) {
            $table->dropColumn('noidungtiengviet');
            $table->dropColumn('cauhoitiengviet');
            $table->dropColumn('Atiengviet');
            $table->dropColumn('Btiengviet');
            $table->dropColumn('Ctiengviet');
            $table->dropColumn('Dtiengviet');
        });
    }
};
