<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksOrderBuyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_order_buy', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->unsigned();
            $table->foreign('buyer_id')->references('id')->on('books_reader_profile');
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('books_store');
            $table->integer('amount')->default(0);
            $table->decimal('price', 8, 2);
            $table->dateTime('buy_date');
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
        Schema::dropIfExists('books_order_buy');
    }
}
