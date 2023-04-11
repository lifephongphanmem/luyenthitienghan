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
        Schema::create('hocvien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mahocvien',50)->nullable();
            $table->string('malop',50)->nullable();
            $table->string('tenhocvien')->nullable();
            $table->string('cccd')->nullable();
            $table->string('sdt')->nullable();
            $table->string('email')->nullable();
            $table->string('ngaysinh')->nullable();
            $table->integer('gioitinh')->default(1)->comment('1:nam, 0:nu');
            $table->string('diachi')->nullable();
            $table->integer('trangthai')->default(1)->comment('1:danghoc,2:hoanthanhkhoahoc,3:nghihoc');
            $table->string('ghichu')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hocvien');
    }
};
