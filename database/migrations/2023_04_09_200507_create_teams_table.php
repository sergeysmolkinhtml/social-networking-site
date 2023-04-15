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
        Schema::create('coop_teams', function (Blueprint $table) {
            $table->id();
            $table->string('search_for')->comment('Developer who you are searching for')->nullable();
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->enum('user_grade',['junior','middle','senior'])->nullable();
            $table->set('accept_with_grade',['junior','middle','senior'])->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
