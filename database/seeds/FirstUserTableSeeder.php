<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class FirstUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Test User',
            'email' => 'test.user@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => User::ROLE_ADMIN_GLOBAL
        ]);
    }
}
