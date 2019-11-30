<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksStoreBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_store_book', function (Blueprint $table) {
            $table->integer('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books_book');
            $table->integer('store_id')->unsigned();
            $table->foreign('store_id')->references('id')->on('books_store')->onDelete('CASCADE');
            $table->integer('amount')->default(0);
            $table->decimal('price', 8, 2);
            $table->integer('stock')->default(0);
            $table->boolean('status')->default(false);
            $table->primary(['book_id', 'store_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_store_book');
    }
}
