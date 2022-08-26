<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MBTIVotes extends Model
{
    use HasFactory;

    protected $table = 'typology_votes';
    protected $fillable = [
        'user_id',
            'person_id',
            'vote',
    ];
}
