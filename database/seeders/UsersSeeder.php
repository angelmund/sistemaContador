<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //crea mis usuarios
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com.com',
                'password' => bcrypt('password'),
                'estado' => 1,
            ],
            
            [
                'name' => 'Admin2',
                'email' => 'admin2@gmail.com.com',
                'password' => bcrypt('password'),
                'estado' => 1,
            ],
        ];

        //inserta los usuarios y obtiene sus IDs
        $userIds = [];
        foreach ($users as $user) {
            $userIds[] = DB::table('users')->insertGetId($user);
        }

        //asigna los roles a los usuarios
        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => $userIds[0],
            ],
            [
                'role_id' => 2,
                'user_id' => $userIds[1],
            ],
        ]);
    }
}