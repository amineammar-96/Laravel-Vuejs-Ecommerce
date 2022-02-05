<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->string('name');
            $table->string('image');
            $table->integer('quantity');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('seller')->unsigned();
            $table->decimal('price');
            $table->String('orderItemStatus')->default('Confirmed');
            $table->timestamp('cancled_at')->nullable();
            $table->String('confirmedReceivedStatus')->nullable();
            $table->timestamp('confirmedReceivedStatus_at')->nullable();
            
            $table->increments('id');
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
        Schema::dropIfExists('order_items');
    }
}
