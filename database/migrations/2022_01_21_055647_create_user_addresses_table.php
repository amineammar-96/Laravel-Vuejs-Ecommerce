<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->String('name');
            $table->String('phone');
            $table->text('address');
            $table->text('addressComp')->nullable();
            $table->String('city');
            $table->String('country');

            $table->String('postalCode');
            $table->String('buldingCode')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('defaultAddress');

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
        Schema::dropIfExists('user_addresses');
    }
}
