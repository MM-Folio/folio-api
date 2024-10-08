<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'valid_till',
        'urlId',
    ];

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'portfolio_artists', 'portfolio_id', 'artist_id');
    }
}
