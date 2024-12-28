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
        Schema::create('congcu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phanloai')->nullable();
            $table->string('macongcu')->nullable();
            $table->string('tencongcu')->nullable();
            $table->string('hinhanh')->nullable();
            $table->string('tiengHan')->nullable();
            $table->string('tiengViet')->nullable();
            $table->integer('stt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('congcu');
    }
};
