<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory(2)->create();

        $user = User::first();
        $user->name = "Administrator";
        $user->username = "administrator";
        $user->email = "admin@gmail.com";
        $user->password = Hash::make('admin');
        $user->role_id = 1;
        $user->save();
    }
}
