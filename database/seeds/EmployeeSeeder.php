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
            ]
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
