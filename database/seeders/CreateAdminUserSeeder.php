<?php
  
namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
  
class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * 
     */
    public function run() {

        if (count(Permission::all()) > 0) {

            // Default user role is role-list 
            $arr = ['name' => 'Subscriber'];
            if (!Role::where($arr)->first()) {
                $role = Role::create($arr);
                $permission = Permission::where('name', 'role-comment')->first();
                $role->syncPermissions($permission->id);
            }

            // Creating Admin user with all roles
            $arr = ['name' => 'Admin'];
            if (!Role::where($arr)->first()) {
                $role = Role::create($arr);
                $permissions = Permission::pluck('id','id')->all();
                $role->syncPermissions($permissions);
            }
                  
        }else {
            return "Please run PermissionTableSeeder first \r\n";
        }
         
    }
}