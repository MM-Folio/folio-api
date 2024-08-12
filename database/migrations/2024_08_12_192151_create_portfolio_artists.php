<?php

use App\Models\Portfolio;
use App\Models\Artist;
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
        Schema::create('portfolio_artists', function (Blueprint $table) {
            $table->foreignIdFor(Portfolio::class, 'portfolio_id');
            $table->foreignIdFor(Artist::class, 'artist_id');
            $table->timestamps();

            $table->primary(['portfolio_id', 'artist_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_artists');
    }
};
