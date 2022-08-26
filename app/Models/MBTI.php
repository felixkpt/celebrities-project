<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MBTI extends Model
{
    use HasFactory;
    
    protected $table = 'typologies';
    
    protected $fillable = [ 'name',
                            'slug',
                            'strength',
                            'description',
                            'prevalence',
                            'featured_image',
                            ];
}
