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
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('who_finding')->nullable();
            $table->string('candidate_sphere')->nullable();
            $table->text('vacancy_description')->nullable();
            $table->string('city')->nullable();
            $table->string('languages')->nullable();
            $table->string('linkedin_page')->nullable();
            $table->foreignId('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employers');
    }
};
