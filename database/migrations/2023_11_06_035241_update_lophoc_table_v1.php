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
        Schema::table('lophoc', function (Blueprint $table) {
            $table->integer('phanquyenluyenthi')->default(1);
            $table->string('giaotrinhhoc')->nullable();
            $table->integer('phanquyengiaotrinhhoc')->default(1);
            $table->integer('khoataikhoan')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lophoc', function (Blueprint $table) {
            $table->dropColumn('phanquyenluyenthi');
            $table->dropColumn('giaotrinhhoc');
            $table->dropColumn('phanquyengiaotrinhhoc');
            $table->dropColumn('khoataikhoan');
        });
    }
};
