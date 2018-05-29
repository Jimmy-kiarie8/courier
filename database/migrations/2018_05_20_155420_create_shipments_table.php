<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('sender_address')->nullable();
            $table->string('sender_city')->nullable();
            $table->integer('sender_phone')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_postal_code')->nullable();
            $table->string('client_region')->nullable();
            $table->string('client_city')->nullable();
            $table->integer('client_phone')->nullable();
            $table->string('assign_staff')->nullable();
            $table->string('airway_bill_no')->nullable();
            $table->integer('bar_code')->nullable();
            $table->integer('amount_ordered')->nullable();
            $table->integer('shipment_id');
            $table->boolean('paid')->nullable();
            $table->string('status')->nullable();
            $table->string('container')->nullable();
            $table->string('driver')->nullable();
            $table->string('payment')->nullable();
            $table->string('shipment_type')->nullable();
            $table->string('insuarance_status')->nullable();
            $table->integer('total_freight')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('derivery_date')->nullable();
            $table->time('derivery_time')->nullable();
            $table->text('remark')->nullable();
            $table->string('derivery_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipments');
    }
}
