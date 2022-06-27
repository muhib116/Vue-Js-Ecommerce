<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_products', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id');
            $table->integer('vendor_id');
            $table->decimal('seller_rate', 10,0)->nullable()->default('0');
            $table->decimal('office_rate', 10,0)->nullable()->default('0');
            $table->string('quantity', 15)->default(1);
            $table->integer('day')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('position')->nullable();
            $table->tinyInteger('approved')->default('1');
            $table->string('status', 10)->default('pending');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('affiliate_products');
    }
}
