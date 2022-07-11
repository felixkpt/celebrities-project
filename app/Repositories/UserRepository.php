<?php 
namespace App\Repositories;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Model {
    
    public function __construct()
    {
        return new User();
    }
}