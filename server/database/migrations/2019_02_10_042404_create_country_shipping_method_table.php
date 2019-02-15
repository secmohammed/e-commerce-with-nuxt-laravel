<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryShippingMethodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_shipping_method', function (Blueprint $table) {
            $table->integer('country_id')->unsigned()->index();
            $table->integer('shipping_method_id')->unsigned()->index();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('country_shipping_method', function (Blueprint $table) {
            $table->dropForeign(['country_id','shipping_method_id']);
        });
        Schema::dropIfExists('country_shipping_method');
    }
}
