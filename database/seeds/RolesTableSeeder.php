<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
			'slug' => 'modem',
			'name' => 'Moderator',
		]);

        Role::create([
			'slug' => 'admin',
			'name' => 'Administrator'
    	]);
    }
}
