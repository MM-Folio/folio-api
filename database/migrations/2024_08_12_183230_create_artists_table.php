<?php

use App\Models\Genre;
use App\Models\Picture;
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
        Schema::create('artists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(Picture::class);
            $table->foreignIdFor(Genre::class);
            $table->string('location');
            $table->string('description', 2000);
            $table->string('instaHandle');
            $table->string('ytEmbedUrl');
            $table->string('spotifyEmbedUrl');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists');
    }
};
