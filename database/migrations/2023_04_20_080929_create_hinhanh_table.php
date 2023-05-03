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
        Schema::create('hinhanh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mabaihoc',50)->nullable();
            $table->string('mahinhanh',50)->nullable();
            $table->string('hinhanh')->nullable();
            $table->string('audio')->nullable();
            $table->string('tienghan')->nullable();
            $table->string('A')->nullable();
            $table->string('B')->nullable();
            $table->string('C')->nullable();
            $table->string('D')->nullable();
            $table->string('dapan')->nullable();
            $table->integer('stt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hinhanh');
    }
};
