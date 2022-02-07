<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin =Role::create([


            'name'=>'super_admin',
            'display_name'=>'super_admin',
            'description'=>'can do any thing in my system',

        ]);
        $Admin =Role::create([


            'name'=>'admin',
            'display_name'=>'admin',
            'description'=>'can do spacific roles',

        ]);
    }
}
