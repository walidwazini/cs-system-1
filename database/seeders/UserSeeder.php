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
                'name' => 'Vam',
                "email" => 'vam@email.com',
                "password" => bcrypt('vam123456')
            ]
        ];
        DB::table('users')->insert($users);
    }
}