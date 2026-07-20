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
        Schema::create('convert_kits', function (Blueprint $table) {
            $table->id();
            $table->integer('transcript_id')->nullable();
            $table->text('payload')->nullable();
            $table->text('convert_kit_response');
            $table->string('subscriber_id')->nullable();
            $table->string('subscription_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('form_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('convert_kits');
    }
};
