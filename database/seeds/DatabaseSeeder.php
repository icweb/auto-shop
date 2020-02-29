<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(ServicesSeeder::class);

        $this->call(DemoSeeder::class);
    }
}
