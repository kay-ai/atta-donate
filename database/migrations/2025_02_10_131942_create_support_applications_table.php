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
        Schema::create('support_applications', function (Blueprint $table) {
            $table->id();
            $table->string('support_type');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('area_of_interest')->nullable();
            $table->string('cv')->nullable();
            $table->string('institution')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_applications');
    }
};
