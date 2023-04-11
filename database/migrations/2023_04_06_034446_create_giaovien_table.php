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
        Schema::create('giaovien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('magiaovien',50)->nullable();
            $table->string('tengiaovien')->nullable();
            $table->string('cccd')->nullable();
            $table->string('sdt',20)->nullable();
            $table->string('email')->nullable();
            $table->integer('gioitinh')->default(0)->comment('1:nam,0:nu');
            $table->string('ngaysinh')->nullable();
            $table->integer('trangthai')->default(1)->comment('1:dangcongtac,2:nghiphep,3:nghiviec');
            $table->string('ghichu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giaovien');
    }
};
