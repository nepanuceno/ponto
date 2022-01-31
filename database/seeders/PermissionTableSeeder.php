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
            'perfil-list',
            'perfil-create',
            'perfil-edit',
            'perfil-delete',
            'permissao-list',
            'permissao-create',
            'permissao-edit',
            'permissao-delete',
            'servidor-list',
            'servidor-create',
            'servidor-edit',
            'servidor-delete',
            'usuario-list',
            'usuario-create',
            'usuario-edit',
            'usuario-delete',
            'logs-list',
            'imprimir-livro-ponto'
         ];

         foreach ($permissions as $permission) {

            try {
                Permission::create(['name' => $permission]);
                echo $permission." criada com sucesso!";
                //code...
            } catch (\Throwable $th) {
                //throw $th;

            }
         }
    }
}
