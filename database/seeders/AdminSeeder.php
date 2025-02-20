<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@atta.ng'],
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'email' => 'admin@atta.ng',
                'password' => Hash::make('soJrox-wyrqog-8tusmo'),
                'user_type' => 'admin',
            ]
        );
    }
}
