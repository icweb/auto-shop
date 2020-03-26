<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedBigInteger('invoice_id');
            $table->unsignedBigInteger('appointment_service_id')->nullable();
            $table->unsignedBigInteger('rendered_service_id')->nullable();
            $table->unsignedBigInteger('unit_price')->default(1);
            $table->string('description')->nullable();
            $table->unsignedBigInteger('quantity')->default(1);
            $table->unsignedBigInteger('line_total')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('author_id')->references('id')->on('users');
            $table->foreign('appointment_service_id')->references('id')->on('appointment_services');
            $table->foreign('rendered_service_id')->references('id')->on('rendered_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
}
