<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $asYouType = true;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
    
    protected $fillable = [
        'title', 'slug', 'description', 'post_type', 'image', 'published'];
    
    /**
     * Authors relationship method
     * 1 to many (One post can belong to one or more Authors)
     */
    public function author() {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'manager_id')
        ->withTimestamps()
        // ->wherePivot('post_user.manager_id', '>', 1)
        ->withPivot('manager_id')
        ;
    }

    /**
     * Authors relationship method
     * 1 to many (One post can belong to one or more Authors)
     */
    public function authors() {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id')
        ->withTimestamps()
        ->withPivot('manager_id')
        ;
    }

    /**
     * Category relationship method
     * 1 to many (One post can belong to one or more Categories)
     */
    public function category() {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id')
        ->withTimestamps();
    }

    /**
     * Categories relationship method
     * 1 to many (One post can belong to one or more Categories)
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'post_category', 'post_id', 'category_id')
        ->withTimestamps();
    }

    public function content() {
        return $this->hasOne(PostContent::class, 'post_id');
    }

    /**
     * Main Authors relationship method
     * 1 to many (One post can belong to one or more Authors)
     */
    public function mainAuthors() {
        return $this->belongsToMany(User::class, 'post_user', 'post_id', 'user_id')
        ->withTimestamps()
        ->withPivot(['manager_id'])
        ->using(\App\Models\PostUser::class);
    }

    /**
     * Defining relationship between post and review a post can have many reviews
     */
    public function reviews() {
        return $this->hasMany(Review::class, 'post_id', 'id');
    }
}

