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
        Schema::create('vandap_cautraloi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('macau',50)->nullable();
            $table->string('macautraloi',50)->nullable();
            $table->string('noidung')->nullable();
            $table->string('nghiatiengviet')->nullable();
            $table->integer('stt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vandap_cautraloi');
    }
};
