<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $roles = ["admin", "doctor", "patient"];

        foreach($roles as $role){
            Role::create(['name' => $role]);
        }

        $user= User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);

        $user->assignRole('admin');
        Service::factory(10)->create();

    }
}
