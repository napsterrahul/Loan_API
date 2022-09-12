<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
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
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'user_type' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'User 1',
            'email' => 'user1@admin.com',
            'password' => Hash::make('12345678'),
            'user_type' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'User 2',
            'email' => 'user2@admin.com',
            'password' => Hash::make('12345678'),
            'user_type' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'User 3',
            'email' => 'user3@admin.com',
            'password' => Hash::make('12345678'),
            'user_type' => 2,
        ]);
    }
}
