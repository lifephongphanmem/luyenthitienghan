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
        Schema::create('dsnhomtaikhoan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stt')->default(1);
            $table->string('manhomchucnang',50)->nullable();
            $table->string('tennhomchucnang',50)->nullable();           
            $table->string('ghichu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dsnhomtaikhoan');
    }
};
