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
        Schema::create('village_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('history')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->text('geographic_location')->nullable();
            $table->string('area')->nullable();
            $table->integer('population')->nullable();
            $table->integer('districts')->nullable();
            $table->string('village_head')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('village_profiles');
    }
};
