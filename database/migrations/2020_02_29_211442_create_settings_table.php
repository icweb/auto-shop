<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id');
            $table->string('global_nav_foreground_color')->default('#FFFFFF');
            $table->string('global_nav_background_color')->default('#343A40');
            $table->boolean('vehicle_show_mileage_history')->default(1);
            $table->string('calendar_left_buttons')->default('prev,addEventButton,next');
            $table->string('calendar_middle_buttons')->default('title');
            $table->string('calendar_right_buttons')->default('today,month,dayGridMonth,dayGridWeek,timeGridDay,list');
            $table->string('invoice_business_name')->default('Copelli Auto Service');
            $table->string('invoice_address')->default('1549 5th Ave,<br>Latrobe, PA 15650');
            $table->string('invoice_phone')->default('724-539-2756');
            $table->longText('invoice_hours');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
