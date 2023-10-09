<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Ava',
                "email" => 'vam@email.com',
                "password" => bcrypt('ava123')
            ]
        ];
        DB::table('users')->insert($users);
    }
}