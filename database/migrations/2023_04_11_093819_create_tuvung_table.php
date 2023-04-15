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
        Schema::create('tuvung', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mabaihoc',50)->nullable();
            $table->string('matuvung',50)->nullable();
            $table->integer('cumtuvung')->nullable();
            $table->string('audio')->nullable();
            $table->string('tutienghan')->nullable();
            $table->string('tiengviet')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuvung');
    }
};
