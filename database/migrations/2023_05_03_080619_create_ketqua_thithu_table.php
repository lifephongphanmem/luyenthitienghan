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
        Schema::create('ketquathithu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('maketqua',50)->nullable();
            $table->string('mahocvien',50)->nullable();
            $table->integer('solanthi')->nullable();
            $table->integer('diemcaonhat')->nullable();
            $table->dateTime('thoigianthigannhat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketquathithu');
    }
};
