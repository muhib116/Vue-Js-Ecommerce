<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('assign_by');
            $table->string('subject');
            $table->string('slug');
            $table->dateTime('start_date')->default(now());
            $table->dateTime('end_date')->nullable();
            $table->longText('details')->nullable();
            $table->string('attachment')->nullable();
            $table->tinyInteger('sms_notify')->nullable();
            $table->string('priority', 10)->nullable();
            $table->string('status', 10)->default('pending');
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
        Schema::dropIfExists('working_tasks');
    }
}
