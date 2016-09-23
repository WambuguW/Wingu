<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CoreDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

                $this->call('App\Modules\Core\Database\Seeds\UserTableSeeder');
		$this->call('App\Modules\Core\Database\Seeds\ClassesTableSeeder');
                $this->call('App\Modules\Core\Database\Seeds\DormitoriesTableSeeder');
                $this->call('App\Modules\Core\Database\Seeds\StreamsTableSeeder');
                $this->call('App\Modules\Core\Database\Seeds\StudentdetailsTableSeeder');                
                $this->call('App\Modules\Core\Database\Seeds\StudentclassTableSeeder'); 
                
                Model::reguard();
	}
}
