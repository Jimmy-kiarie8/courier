<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('containers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bar_code')->nullable();
            $table->string('shipments')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('assign_staff')->nullable();
            $table->string('status')->nullable();
            $table->string('airway_bill_no')->nullable();
            $table->date('derivery_date')->nullable();
            $table->time('derivery_time')->nullable();
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
        Schema::dropIfExists('containers');
    }
}
