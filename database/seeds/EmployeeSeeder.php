<?php

use Illuminate\Database\Seeder;
use App\DataEmployee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
        	['employeeNumber' => 1001, 'firstName' => 'Dedi', 'lastName' => 'Kurniawan'],
            ['employeeNumber' => 1002, 'firstName' => 'Musthofa', 'lastName' => 'Kemal'],
            ['employeeNumber' => 1003, 'firstName' => 'Darmawan', 'lastName' => 'Fandi'],
            ['employeeNumber' => 1004, 'firstName' => 'Fonfei', 'lastName' => 'Tseng'],
        ];

        foreach ($datas as $data) {
	        DataEmployee::create($data);
	    }
    }
}
