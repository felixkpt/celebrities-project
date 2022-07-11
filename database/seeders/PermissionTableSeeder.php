<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'role-comment',
           'post-create',
           'post-edit',
           'post-delete',
           'person-create',
           'person-edit',
           'person-delete',
        ];
     
        foreach ($permissions as $permission) {
             if (!Permission::where('name', $permission)->first()) {
                Permission::create(['name' => $permission]);
             }
        }
    }
}