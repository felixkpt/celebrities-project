<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypologyVotes extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
            'person_id',
            'vote',
    ];
}
