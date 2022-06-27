<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateAgentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_agent_products', function (Blueprint $table) {
            $table->id();
            $table->integer('affiliate_product_id');
            $table->integer('product_id');
            $table->integer('agent_id');
            $table->decimal('agent_price', 10,0);
            $table->integer('views')->default(0);
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
        Schema::dropIfExists('affiliate_agent_products');
    }
}
