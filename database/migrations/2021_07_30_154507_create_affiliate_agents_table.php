<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_agents', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('referral_code', '10');
            $table->string('referral_website')->nullable();
            $table->string('label', 15)->nullable();
            $table->text('details')->nullable();
            $table->string('status', 10)->default('pending');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('affiliate_agents');
    }
}
