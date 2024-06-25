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
        Schema::create('music_tracks', function (Blueprint $table) {
            $table->id();
            $table->string('track_id');
            $table->string('name');
            $table->string('duration');
            $table->integer('album_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->float('acousticness');
            $table->float('danceability');
            $table->float('energy');
            $table->float('key');
            $table->float('loudness');
            $table->float('mode');
            $table->float('tempo');
            $table->integer('time_signature');
            $table->float('valence');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_tracks');
    }
};
