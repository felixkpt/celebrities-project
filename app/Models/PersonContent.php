<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'person_id',
        'worth',
        'website',
        'hobbies',
        'quotes',
        'content',
    ];

}
