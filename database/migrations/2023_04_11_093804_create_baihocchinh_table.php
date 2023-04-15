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
        Schema::create('baihocchinh', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mabaihoc',50)->nullable();
            $table->string('mabaihocchinh',50)->nullable();
            $table->string('loaisach')->nullable();
            $table->string('audio')->nullable();
            $table->string('anh')->nullable();
            $table->integer('stt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baihocchinh');
    }
};
