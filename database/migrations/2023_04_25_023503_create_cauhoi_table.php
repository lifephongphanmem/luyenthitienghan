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
        Schema::create('cauhoi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('macauhoi',50)->nullable();
            $table->string('loaicauhoi')->nullable()->comment('1:nghehieu;2:dochieu');
            $table->string('cauhoi')->nullable();
            $table->ntext('noidung')->nullable();
            $table->string('audio')->nullable();
            $table->string('anh')->nullable();
            $table->integer('loaidapan')->nullable()->comment('1:text;2:anh');
            $table->string('A')->nullable();
            $table->string('B')->nullable();
            $table->string('C')->nullable();
            $table->string('D')->nullable();
            $table->string('dapan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cauhoi');
    }
};
