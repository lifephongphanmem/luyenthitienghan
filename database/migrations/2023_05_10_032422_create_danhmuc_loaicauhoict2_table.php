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
        Schema::create('chitietloaicauhoict', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('madmct',50)->nullable();
            $table->string('madmct2',50)->nullable();
            $table->string('tendmct2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loaicauhoict2');
    }
};
