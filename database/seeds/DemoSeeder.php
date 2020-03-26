<?php

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        $body_types = ['Sedan', 'Coop', 'SUV'];

        $days = 0;

        for($x = 0; $x < 100; $x++)
        {
            $customer = new \App\Customer();
            $customer->author_id = 1;
            $customer->first_name = $faker->firstName;
            $customer->last_name = $faker->lastName;
            $customer->home_phone = rand(1000000000,9999999999);
            $customer->mobile_phone = rand(1000000000,9999999999);
            $customer->email = $faker->safeEmail;
            $customer->comments = $faker->paragraph;
            $customer->save();

            for($y = 0; $y < rand(1,3); $y++)
            {
                $vehicleData = $faker->vehicleArray;

                $vehicle = new \App\Vehicle();
                $vehicle->author_id = 1;
                $vehicle->customer_id = $customer->id;
                $vehicle->make = $vehicleData['brand'];
                $vehicle->model = $vehicleData['model'];
                $vehicle->year = $faker->year;
                $vehicle->color = $faker->colorName;
                $vehicle->body_type = ucfirst($faker->vehicleType);
                $vehicle->license_plate = ('ABC-' . rand(1000,9999));
                $vehicle->vin = $faker->vin;
                $vehicle->comments = $faker->paragraph;
                $vehicle->save();

                $initialMileage = rand(5000, 100000);

                for($z = 0; $z < rand(1,10); $z++)
                {
                    $mileage = new \App\VehicleMileage();
                    $mileage->author_id = 1;
                    $mileage->vehicle_id = $vehicle->id;
                    $mileage->mileage = $initialMileage;
                    $mileage->save();

                    $initialMileage += rand(1000, 20000);
                }

                for($a = 0; $a < rand(1,3); $a++)
                {
                    $service = \App\Service::all()->random();

                    $rendered_service = new \App\RenderedService();
                    $rendered_service->author_id = 1;
                    $rendered_service->vehicle_id = $vehicle->id;
                    $rendered_service->service_id = $service->id;
                    $rendered_service->customer_id = $customer->id;
                    $rendered_service->employee_id = 2;
                    $rendered_service->cost = $service->cost;
                    $rendered_service->completed_at = \Carbon\Carbon::now();
                    $rendered_service->comments = $faker->paragraph;
                    $rendered_service->save();
                }
            }

            $times = [
                [
                    'start' => [9,00],
                    'end' => [10,00],
                ],
                [
                    'start' => [10,30],
                    'end' => [12,00],
                ],
                [
                    'start' => [13,00],
                    'end' => [14,30],
                ],
                [
                    'start' => [14,45],
                    'end' => [15,30],
                ],
                [
                    'start' => [16,00],
                    'end' => [17,00],
                ],
            ];

            for($b = 0; $b < 5; $b++)
            {
                $start_date = \Carbon\Carbon::now()->addDays($days);

                $appointment = new \App\Appointment();
                $appointment->author_id = 1;
                $appointment->customer_id = $customer->id;
                $appointment->starts_at = $start_date->setTime($times[$b]['start'][0], $times[$b]['start'][1]);
                $appointment->ends_at = $start_date->setTime($times[$b]['end'][0], $times[$b]['end'][1]);
                $appointment->color = $appointment->colors[array_rand($appointment->colors)];
                $appointment->comments = $faker->paragraph;
                $appointment->save();

                $invoice_total_sub = rand(5000,25000);
                $invoice_total_tax = $invoice_total_sub * .06;
                $invoice_total_discount = rand(0, 50);
                $invoice_total_grand = ($invoice_total_sub + $invoice_total_tax) - $invoice_total_discount;
                $invoice = new \App\Invoice();
                $invoice->author_id = 1;
                $invoice->customer_id = $customer->id;
                $invoice->appointment_id = $appointment->id;
                $invoice->status = $invoice->statuses[array_rand($invoice->statuses)];
                $invoice->pay_until_days = 0;
                $invoice->total_sub = $invoice_total_sub;
                $invoice->total_tax = $invoice_total_tax;
                $invoice->total_discount = $invoice_total_discount;
                $invoice->total_grand = $invoice_total_grand;
                $invoice->amount_due = $invoice_total_grand;
                $invoice->amount_paid = 0;
                $invoice->comments =  $faker->paragraph;
                $invoice->due_at = \Carbon\Carbon::now();
                $invoice->paid_at = null;
                $invoice->save();

                for($c = 0; $c < 5; $c++)
                {
                    $random_service = \App\Service::all()->random();
                    $random_vehicle = $customer->vehicles->random();
                    $appointment_service = new \App\AppointmentService();
                    $appointment_service->author_id = 1;
                    $appointment_service->service_id = $random_service->id;
                    $appointment_service->appointment_id = $appointment->id;
                    $appointment_service->vehicle_id = $random_vehicle->id;
                    $appointment_service->cost = $random_service->cost;
                    $appointment_service->comments = $faker->paragraph;
                    $appointment_service->save();

                    $invoice_item = new \App\InvoiceItem();
                    $invoice_item->author_id = 1;
                    $invoice_item->invoice_id = $invoice->id;
                    $invoice_item->appointment_service_id = $appointment_service->id;
                    $invoice_item->unit_price = $random_service->cost;
                    $invoice_item->description = $random_service->name;
                    $invoice_item->quantity = 1;
                    $invoice_item->line_total = $random_service->cost;
                    $invoice_item->save();
                }
            }

            $days += 1;
        }
    }
}
