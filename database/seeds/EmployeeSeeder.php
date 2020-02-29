<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            [
                'name' => 'Katie Copelli',
                'email' => 'katie@example.com',
                'password' => bcrypt('ianisawesome')
            ],
            [
                'name' => 'Jesse Copelli',
                'email' => 'jesse@example.com',
                'password' => bcrypt('katieisawesome')
            ],
        ];

        foreach($employees as $employee)
        {
            $new_employee = new \App\User();
            foreach($employee as $key => $val)
            {
                $new_employee->{$key} = $val;
            }
            $new_employee->save();
        }
    }
}
