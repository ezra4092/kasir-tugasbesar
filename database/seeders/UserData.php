<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
{
    public function run(): void
    {
        $user = [
        [
            'username' => 'admin',
            'password' => 'admin',
            'nama' => 'Admin',
            'level' =>'admin'
        ],
        [
            'username' => 'ezra',
            'password' => '1234',
            'nama' => 'Ezra',
            'level' =>'petugas'
        ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
