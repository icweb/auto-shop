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
                $appointment->comments = $faker->paragraph;
                $appointment->save();
            }

            $days += 1;
        }
    }
}
