<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'admin',
            'email' => 'admin@ngajarin.com',
            'password' => Hash::make('admin'),
            'phone' => '123',
            'address' => 'server',
            'role' => 'admin',
            'status' => 'verified'
        ]);
    }
}
