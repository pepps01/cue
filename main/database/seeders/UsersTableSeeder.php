<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'tester+admin@gmail.com',
            'firstname' => "TestAdmin",
            'lastname' => "Admin",
            'role' => 'superadmin',
            'email_verified_at' => '2021-11-03',
            'application_name' => 'admin',
            'password' => bcrypt('12345678')
        ]);

        Admin::create([
            'user_id' => $user->id,
            'admin_type' => $user->role,
            'status' => true
        ]);

        Wallet::create([
            'user_id' => $user->id
        ]);
    }
}
