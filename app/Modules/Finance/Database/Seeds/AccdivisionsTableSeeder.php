<?php

namespace App\Modules\Finance\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccdivisionsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
            DB::table('accdivisions')->insert([
                'code' => 1,
                'name' => 'ASSETS',
                'description' => 'All assets owned by the institution',
                'funds' => 1,
                'status' => 'Active',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            
            DB::table('accdivisions')->insert([
                'code' => 2,
                'name' => 'LIABILITIES',
                'description' => 'All liabilities under the institution',
                'funds' => 1,
                'status' => 'Active',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            
            DB::table('accdivisions')->insert([
                'code' => 3,
                'name' => 'INCOMES',
                'description' => 'All incomes made to the institution',
                'funds' => 1,
                'status' => 'Active',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            
            DB::table('accdivisions')->insert([
                'code' => 4,
                'name' => 'COSTS & EXPENSES',
                'description' => 'All assets owned by the institution',
                'funds' => 1,
                'status' => 'Active',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
	}
}
