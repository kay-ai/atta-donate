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
        Schema::create('den_applications', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('country');
            $table->string('city');
            $table->string('business_name')->nullable();
            $table->string('business_website')->nullable();
            $table->string('industry');
            $table->string('business_stage');
            $table->string('idea_title');
            $table->text('business_description');
            $table->text('problem_statement');
            $table->text('target_audience');
            $table->text('revenue_model');
            $table->text('competitors');
            $table->string('video_pitch');
            $table->unsignedBigInteger('funding_amount');
            $table->text('funding_usage');
            $table->string('co_founders');
            $table->text('co_founders_details')->nullable();
            $table->string('previous_funding');
            $table->text('funding_source')->nullable();
            $table->boolean('terms_accepted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('den_applications');
    }
};
