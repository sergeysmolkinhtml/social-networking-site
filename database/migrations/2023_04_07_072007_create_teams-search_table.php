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
        Schema::create('team_search', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('search_for')->nullable();
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->mediumText('stack_of_technologies')->nullable();
            $table->enum('user_grade',['junior','middle','senior'])->nullable();
            $table->enum('accept_with_grade',['junior','middle','senior'])->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
