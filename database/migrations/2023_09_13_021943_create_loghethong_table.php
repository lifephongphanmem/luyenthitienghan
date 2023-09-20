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
        Schema::create('loghethong', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip')->nullable();
            $table->string('taikhoantruycap')->nullable();
            $table->string('tentaikhoan')->nullable();
            $table->string('thaotac')->nullable();
            $table->string('chucnang')->nullable();
            $table->string('noidung')->nullable();
            $table->string('thoigian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loghethong');
    }
};
