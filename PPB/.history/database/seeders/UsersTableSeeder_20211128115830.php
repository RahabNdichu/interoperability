<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'firstname'           => 'Admin',
                ''
                'email'          => 'admin@admin.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
            ],
            // [
            //     'id'             => 2,
            //     'name'           => 'sylvia',
            //     'email'          => 'sylvia@admin.com',
            //     'password'       => bcrypt('password'),
            //     'remember_token' => null,
            // ],
        ];

        User::insert($users);
    }
}
