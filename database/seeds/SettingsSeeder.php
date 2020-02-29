<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = new \App\Setting();
        $settings->author_id = 1;
        $settings->vehicle_show_mileage_history = 1;
        $settings->save();
    }
}
