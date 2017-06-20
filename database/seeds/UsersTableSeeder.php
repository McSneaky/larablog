<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create $users nr of random users
        $users = 10;
        factory(User::class, $users)->create();

        $admin_id = Role::where('slug', 'admin')->first()->id;
        $modem_id = Role::where('slug', 'modem')->first()->id;

        // Create one admin
        User::firstOrCreate([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id' => $admin_id,
            'remember_token' => str_random(10),
        ]);

        // Create one modem
        User::firstOrCreate([
            'name' => 'modem',
            'email' => 'modem@modem.com',
            'password' => bcrypt('modem'),
            'role_id' => $modem_id,
            'remember_token' => str_random(10),
        ]);
    }
}
