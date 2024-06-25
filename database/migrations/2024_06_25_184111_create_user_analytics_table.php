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
        Schema::create('user_analytics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('most_listened_genres')->nullable();
            $table->float('average_duration')->nullable();
            $table->float('average_acousticness')->nullable();
            $table->float('average_danceability')->nullable();
            $table->float('average_energy')->nullable();
            $table->float('most_listened_key')->nullable();
            $table->float('average_loudness')->nullable();
            $table->float('most_listened_mode')->nullable();
            $table->float('average_tempo')->nullable();
            $table->integer('most_listened_time_signature')->nullable();
            $table->float('average_valence')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_analytics');
    }
};
