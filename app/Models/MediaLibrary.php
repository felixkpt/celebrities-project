<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaLibrary extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'name', 'url', 'type', 'mime', 'size', 'height', 'width'];

    /**
     * defining author relationship
     */
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
