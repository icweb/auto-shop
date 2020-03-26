<?php

use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        $table->bigIncrements('id');
//        $table->unsignedBigInteger('author_id');
//        $table->string('name');
//        $table->string('cost')->nullable();
//        $table->longText('comments')->nullable();
//        $table->timestamps();
//        $table->softDeletes();
//        $table->foreign('author_id')->references('id')->on('users');

        $services = [
            [
                'name' => 'Oil Change',
                'cost' => 100,
            ],
            [
                'name' => 'Inspection',
                'cost' => 100,
            ],
            [
                'name' => 'Emissions',
                'cost' => 100,
            ],
            [
                'name' => 'Tire Alignment',
                'cost' => 100,
            ],
        ];

        foreach($services as $service)
        {
            $new_service = new \App\Service();
            $new_service->author_id = 1;
            foreach($service as $key => $val)
            {
                $new_service->{$key} = $val;
            }
            $new_service->save();
        }
    }
}
