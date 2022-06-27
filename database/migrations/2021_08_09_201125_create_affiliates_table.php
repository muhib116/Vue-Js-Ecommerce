<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('registration')->default(1);
            $table->tinyInteger('registration_status')->default(1);
            $table->decimal('withdrawal_amount', 10,0)->default(0);
            $table->integer('cookie_duration')->default(10);
            $table->integer('minimum_offer_price')->default(10);
            $table->integer('time_duration')->default(10);
            $table->integer('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliates');
    }
}
