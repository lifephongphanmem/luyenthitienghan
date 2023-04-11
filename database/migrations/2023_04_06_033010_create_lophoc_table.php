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
        Schema::create('lophoc', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('malop',50)->nullable();
            $table->string('tenlop')->nullable();
            $table->string('khoahoc')->nullable();
            $table->string('giaovienchunhiem')->nullable();
            $table->integer('soluonghocvien')->nullable();
            $table->string('stt',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lophoc');
    }
};
