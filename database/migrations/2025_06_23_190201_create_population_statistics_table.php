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
        Schema::create('population_statistics', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->integer('total_male')->default(0);
            $table->integer('total_female')->default(0);
            $table->integer('productive_age')->default(0);
            $table->integer('elderly')->default(0);
            $table->integer('children')->default(0);
            $table->integer('education_primary')->default(0);
            $table->integer('education_secondary')->default(0);
            $table->integer('education_higher')->default(0);
            $table->integer('job_farmers')->default(0);
            $table->integer('job_fishermen')->default(0);
            $table->integer('job_others')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('population_statistics');
    }
};
