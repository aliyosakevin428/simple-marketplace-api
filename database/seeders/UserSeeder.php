<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name'     => 'Superadmin',
                'password' => Hash::make('password'),
            ]
        );

        $superadmin->assignRole('superadmin');

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        $seller = User::firstOrCreate(
            ['email' => 'seller@example.com'],
            [
                'name'     => 'Seller Demo',
                'password' => Hash::make('password'),
            ]
        );
        $seller->assignRole('seller');

        $buyer = User::firstOrCreate(
            ['email' => 'buyer@example.com'],
            [
                'name'     => 'Buyer Demo',
                'password' => Hash::make('password'),
            ]
        );
        $buyer->assignRole('buyer');
    }
}
