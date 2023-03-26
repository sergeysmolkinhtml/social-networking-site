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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employer_id')->references('id')->on('employers');

            $table->string('title');
            $table->string('stack');
            $table->string('team');
            $table->text('expectations');
            $table->text('will_be_a_plus');
            $table->text('will_need_to_do');
            $table->text('what_we_offer');
            $table->text('about_company');
            $table->string('company_site');
            $table->string('experience_years');
            $table->string('category');
            $table->string('domain');
            $table->string('country');
            $table->string('work_formats');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
