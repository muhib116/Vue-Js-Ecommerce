<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_participants', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('quiz_id');
            $table->decimal('quiz_fee', 8,2);
            $table->string('order_id', 15)->nullable();
            $table->integer('allow_participate')->nullable();
            $table->string('division', 25)->nullable();
            $table->string('city', 25)->nullable();
            $table->string('address', 255)->nullable();
            $table->string('currency_sign', 3)->nullable();
            $table->string('payment_method', 20)->default('pending');
            $table->string('tnx_id', 55)->nullable();
            $table->string('payment_info')->nullable();
            $table->string('payment_status', 10)->default('pending');
            $table->string('status', 15)->default('pending');
            $table->dateTime('participate_date')->nullable();
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
        Schema::dropIfExists('quiz_participants');
    }
}
