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
        Schema::table('giaovien', function (Blueprint $table) {
            $table->string('diachi')->nullable()->after('sdt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('giaovien', function (Blueprint $table) {
            $table->dropColumn('diachi');
        });
    }
};
