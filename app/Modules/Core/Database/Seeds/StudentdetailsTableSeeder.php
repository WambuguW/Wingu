<?php

namespace App\Modules\Core\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentdetailsTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
	    DB::table('studentdetails')->insert([
                'admno' => 500,
                'fname' => 'Allan',
                'lname' => 'Okoth',
                'surname' => 'Ouma',
                'contact' => '0719477874',
                'address' => '79-20318',
                'dob' => date('d-M-Y'),
                'sex' => 'M',
                'dormitory' => rand(1, 4),
                'classofadm' => rand(1, 4),
                'currentclass' => rand(1, 4),
                'year' => date('Y'),
                'stream' => rand(1, 4),
                'admdate' => date('d-M-Y'),
                'photo' => 'allanokoth.jpeg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
            
            DB::table('studentdetails')->insert([
                'admno' => 501,
                'fname' => 'Mercy',
                'lname' => 'Chepchirchir',
                'surname' => 'Jepkorir',
                'contact' => '0702148984',
                'address' => '79-20318',
                'dob' => date('d-M-Y'),
                'sex' => 'F',
                'dormitory' => rand(1, 4),
                'classofadm' => rand(1, 4),
                'currentclass' => rand(1, 4),
                'year' => date('Y'),
                'stream' => rand(1, 4),
                'admdate' => date('d-M-Y'),
                'photo' => 'mercyjepkorir.jpeg',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
	}
}
