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
           $table->string('achievements')->after('job_title')->nullable();
           $table->string('skills')->after('job_title')->nullable();
           $table->string('work_experience_years')->after('job_title')->nullable();
           $table->string('languages')->after('job_title')->nullable();
           $table->string('work_format')->after('job_title')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
