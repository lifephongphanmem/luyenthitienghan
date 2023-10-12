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
        Schema::create('vanphonghotro', function (Blueprint $table) {
            $table->id();
            $table->string('maso')->unique();
            $table->string('vanphong')->nullable();
            $table->string('hoten')->nullable();
            $table->string('chucvu')->nullable();
            $table->string('sdt')->nullable();
            $table->string('skype')->nullable();
            $table->string('facebook')->nullable();
            $table->integer('sapxep')->default(99);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vanphonghotro');
    }
};
