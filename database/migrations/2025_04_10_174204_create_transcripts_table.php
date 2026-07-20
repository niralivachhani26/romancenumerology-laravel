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
        Schema::create('transcripts', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('bod')->nullable();
            $table->string('love_path_number')->nullable();
            $table->string('heart_desier_number')->nullable();
            $table->string('love_Desire_number')->nullable();
            $table->string('random_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transcripts');
    }
};
