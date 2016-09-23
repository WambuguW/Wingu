<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentclassTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            DB::table('studentclass')->insert([
                'admno' => 500,
                'class' => 3,
                'year' => 2016,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            
            DB::table('studentclass')->insert([
                'admno' => 501,
                'class' => 2,
                'year' => 2016,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
	}
}
