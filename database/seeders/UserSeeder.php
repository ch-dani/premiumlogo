<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => \Illuminate\Support\Facades\Hash::make('admin@admin.com'),
                'role_id' => \App\Models\Role::getIdByName('admin'),
            ]
        ];

        foreach ($users as $user) {
            \App\Models\User::firstOrCreate(
                [
                    'name' => $user['name'],
                ],
                $user
            );
        }
    }
}
