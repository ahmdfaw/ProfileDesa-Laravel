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
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->integer('total_rw')->nullable()->after('population');
            $table->integer('total_rt')->nullable()->after('total_rw');
            $table->string('hamlet_head')->nullable()->after('total_rt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->dropColumn(['total_rw', 'total_rt', 'hamlet_head']);
        });
    }
};
