<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscTexts extends Model
{
    use HasFactory;

    protected $fillable = [
        'textId',
        'text',
    ];

    
}
