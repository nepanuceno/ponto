<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([

            'name' => 'Paulo Roberto Torres',
            'email' => 'paulo.torres.apps@gmail.com',
            'password' => bcrypt('123456')

        ]);
    }
}
