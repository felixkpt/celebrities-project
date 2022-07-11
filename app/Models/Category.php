<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description', 'image', 'parent'];

    /**
     * Defining the relationship between a category and post
     */
    public function posts() {
        return $this->belongsToMany(Post::class, 'post_category', 'category_id', 'post_id');
    }

}
