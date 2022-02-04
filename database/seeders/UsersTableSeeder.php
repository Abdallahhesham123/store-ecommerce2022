<?php

namespace Database\Seeders;
use App\Models\Admin;


use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user1= User::create([

        //     'first_name'=>'abdallah',
        //     'last_name'=>'hesham',
        //     'email'=>'abdallahhesham@gmail.com',
        //     'password'=>bcrypt('123123123')

        // ]);
        // $user2=  User::create([


        //     'first_name'=>'amany',
        //     'last_name'=>'hossam',
        //     'email'=>'amanyhossam@gmail.com',
        //     'password'=>bcrypt('123456789')

        // ]);
        // $user3= User::create([


        //     'first_name'=>'hesham',
        //     'last_name'=>'abdallah',
        //     'email'=>'heshamabdallah@gmail.com',
        //     'password'=>bcrypt('01096519434')

        // ]);
       $user= Admin::create([


            'name'=>'abdallah',

            'email'=>'abdallah@gmail.com',
            'password'=>bcrypt('secret')

        ]);

        // $user->attachRole('super_admin');
        // $user1->attachRole('admin');
        // $user2->attachRole('admin');
        // $user3->attachRole('super_admin');
    }
}
