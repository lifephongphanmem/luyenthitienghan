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
        Schema::create('dschucnang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('maso')->nullable();
            $table->string('tencn')->nullable();
            $table->integer('parent')->default(1);
            $table->integer('capdo')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('machucnang_goc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dschucnang');
    }
};
