<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('order_details', function(Blueprint $table) {
        $table->increments('id');
        $table->integer('order_id');
        $table->integer('product_id');
        $table->integer('quantity');
        $table->decimal('price_per_unit', 9, 2);//the price at the time of the sale, just in case we need to do a return and the price got raised at some point we dont refund too much. jk we don't refund
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
      Schema::drop('order_details');
    }
}
