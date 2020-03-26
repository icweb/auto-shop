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
        $settings->invoice_hours = '<br><b>Monday</b> 8AM–5PM<br><b>Tuesday</b> 8AM–5PM<br><b>Wednesday</b> 8AM–5PM<br><b>Thursday</b> 8AM–5PM<br><b>Friday</b> 8AM–5PM<br><b>Saturday</b> Closed<br><b>Sunday</b> Closed<br>';
        $settings->save();
    }
}
