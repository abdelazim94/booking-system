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

        for($i=0;$i<5;$i++){
            $service = new Service();
            $service->setFieldsTranslations([
                'name' => [
                    'en' => 'service_en'.$i,
                    'ar' => 'service_ar'.$i
                ],
                'description' => [
                    'en' => 'description_en'.$i,
                    'ar' => 'description_ar'.$i
                ]
            ]);

        }

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
            'slot'=>30,
            'service_id' => 1
        ]);
        $patient= Patient::create([
            'name' => 'patient',
            'mobile' => '01128896776',
            'password' => bcrypt('123456'),
        ]);

        // $user->assignRole('admin');
        // Service::factory(10)->create();


    }
}
