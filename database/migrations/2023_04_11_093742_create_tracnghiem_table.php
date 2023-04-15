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
        Schema::create('tracnghiem', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mabaihoc',50)->nullable();
            $table->string('matracnghiem',50)->nullable();
            $table->string('tencautracnghiem')->nullable();
            $table->string('noidung')->nullable();
            $table->string('audio')->nullable();
            $table->string('A')->nullable();
            $table->string('B')->nullable();
            $table->string('C')->nullable();
            $table->string('D')->nullable();
            $table->string('dapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracnghiem');
    }
};
