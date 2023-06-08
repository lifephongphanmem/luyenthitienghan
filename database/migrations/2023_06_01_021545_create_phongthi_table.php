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
        Schema::create('phongthi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('maphongthi',50)->nullable();
            $table->string('tenphongthi')->nullable();
            $table->integer('trangthai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phongthi');
    }
};
