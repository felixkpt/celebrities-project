<?php

namespace App\Models;

use App\Models\Typology;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    /**
     * The fields that are mass assignable
     */
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'nickname',
        'slug',
        'gender',
        'dob',
        'birth_month',
        'birth_day',
        'age',
        'county',
        'city',
        'state',
        'country',
        'country_code',
        'professional_id',
        'favorite_quote',
        'description',
        'typology',
        'enneagram',
        'image',
        'timezone',
        'timezone_description',
        'died_on',
        'birth_place',
        'birth_sign',
    ];

    public function personality()
    {
        return $this->belongsTo(Typology::class, 'typology', 'name');
    }

    public function content()
    {
        return $this->hasOne(PersonContent::class, 'person_id');
    }

    // defining relationship between person and professional
    public function professional()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }
}
