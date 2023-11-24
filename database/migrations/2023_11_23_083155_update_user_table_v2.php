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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('trangthaithithu')->default(0);
            $table->string('malop',50)->nullable();
            $table->string('ngaysinh')->nullable();
            $table->integer('gioitinh')->default(1)->comment('1:nam, 0:nu');
            $table->string('diachi')->nullable();
            $table->integer('solandn')->default(0);
            $table->integer('dnlandau')->default(0)->comment('0:dnlan dau, 1:dn hon 1 lan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('trangthaithithu');
            $table->dropColumn('malop');
            $table->dropColumn('ngaysinh');
            $table->dropColumn('gioitinh');
            $table->dropColumn('diachi');
            $table->dropColumn('solandn');
            $table->dropColumn('dnlandau');
        });
    }
};
