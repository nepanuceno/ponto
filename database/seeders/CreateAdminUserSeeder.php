<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        try {
            $user = User::create([
                'name' => 'Administrador',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456')
            ]);

            $role = Role::create(['name' => 'Administrador']);
            $permissions = Permission::pluck('id','id')->all();
            $role->syncPermissions($permissions);
            $user->assignRole([$role->id]);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            echo "Algo deu errado: ".$th;
        }
    }
}
