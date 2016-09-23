<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DormitoriesTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            
            DB::table('dormitories')->insert([
                'name' => 'Longonot',
                'capacity' => 150,
                'sex' => 'M',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('dormitories')->insert([
                'name' => 'Ngong',
                'capacity' => 150,
                'sex' => 'M',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('dormitories')->insert([
                'name' => 'Aberdare',
                'capacity' => 150,
                'sex' => 'F',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            DB::table('dormitories')->insert([
                'name' => 'Menengai',
                'capacity' => 150,
                'sex' => 'F',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
	}
}
