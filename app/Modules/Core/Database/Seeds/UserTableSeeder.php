<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            DB::table('users')->insert([
                'name' => 'Wilson',
                'username' => 'Wilson',
                'email' => 'wambuguw.wilson@gmail.com',
                'password' => Hash::make('Wilson'),
                'role' => 1,
                'active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            
            DB::table('users')->insert([
                'name' => 'Developer',
                'username' => 'Developer',
                'email' => 'wambuguw.wilson@gmail.com',
                'password' => Hash::make('Developer'),
                'role' => 0,
                'active' => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
	}
}
