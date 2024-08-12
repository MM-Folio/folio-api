<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'picture_id',
        'genre_id',
        'location',
        'description',
        'instaHandle',
        'ytEmbedUrl',
        'spotifyEmbedUrl',
    ];

    public function picture()
    {
        return $this->belongsTo(Pictures::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function portfolios()
    {
        return $this->belongsToMany(Portfolio::class, 'portfolio_artists', 'artist_id', 'portfolio_id');
    }
}
