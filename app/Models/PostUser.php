<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PostUser extends Pivot
{
    use HasFactory;

    /**
     * Defining our model relationship
     */
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
    

}
