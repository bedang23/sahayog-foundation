<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()
            ->where('email', '!=', 'admin@sahayog.com')
            ->delete();

        User::query()->updateOrCreate(
            ['email' => 'admin@sahayog.com'],
            [
                'name' => 'Sahayog Admin',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
