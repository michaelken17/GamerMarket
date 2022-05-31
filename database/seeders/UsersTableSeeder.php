<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Admin",
            "email" => "admin@outlook.com",
            "password" => Hash::make('adminpass'),
            "role" => "admin",
            "phone" => "012345678910",
            "address" => "Jalanan Admin"
        ]);
    }
}
