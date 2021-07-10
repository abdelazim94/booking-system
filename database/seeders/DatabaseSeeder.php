<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Service;

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

        // $roles = ["admin", "doctor", "patient"];

        // foreach($roles as $role){
        //     Role::create(['name' => $role]);
        // }

        $admin= Admin::create([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('123456'),
        ]);
        $doctor= Doctor::create([
            'name' => 'doctor1',
            'email' => 'doc@doc.com',
            'mobile' => '01128896777',
            'password' => bcrypt('123456'),
            'slot'=>30
        ]);
        $patient= Patient::create([
            'name' => 'patient',
            'mobile' => '01128896776',
            'password' => bcrypt('123456'),
        ]);

        // $user->assignRole('admin');
        Service::factory(10)->create();

    }
}
