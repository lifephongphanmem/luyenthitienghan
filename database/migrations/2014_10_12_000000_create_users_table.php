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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mataikhoan',50)->nullable();
            $table->string('tentaikhoan')->nullable();
            $table->string('cccd')->nullable();
            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('sodienthoai')->nullable();
            $table->string('trangthai')->nullable();
            $table->string('sadmin')->nullable();
            $table->string('manhomchucnang')->nullable();
            $table->boolean('hocvien')->default(0);
            $table->boolean('giaovien')->default(0);
            $table->boolean('hethong')->default(0);
            $table->boolean('chucnangkhac')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
