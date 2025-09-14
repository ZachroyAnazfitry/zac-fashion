<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            // admin
           [
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            // hash password
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
            'status' => 'active',
           ],

            // vendor/seller
            [
            'name' => 'Vendor',
            'username' => 'Vendor',
            'email' => 'vendor@gmail.com',
            // hash password
            'password' => Hash::make('vendor12345'),
            'role' => 'vendor',
            'status' => 'active',
            ],

             // user/customer
            [
            'name' => 'User',
            'username' => 'User',
            'email' => 'user@gmail.com',
            // hash password
            'password' => Hash::make('user12345'),
            'role' => 'user',
            'status' => 'active',
            ],
           ]);
    }
}
