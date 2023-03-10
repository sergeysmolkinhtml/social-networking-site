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
        Schema::create('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('first_name');
            $table->string('nickname')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('city')->nullable();

            $table->string('password',60);

            $table->date('date_of_birth')->nullable();
            $table->string('status_description')->nullable();
            $table->timestampTz('last_visited_at')->nullable();
            $table->ipAddress('last_visited_from')->nullable();

            $table->boolean('active')->default(1);
            $table->string('verification_token',100)->nullable();
            $table->timestamp('email_verified_at')->nullable();

            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
