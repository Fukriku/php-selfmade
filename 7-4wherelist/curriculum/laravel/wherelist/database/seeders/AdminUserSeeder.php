<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test2@example.com'],
            [
                'name' => '管理者',
                'password' => Hash::make('1234'),
                'admin' => 1,
            ]
        );
    }
}
