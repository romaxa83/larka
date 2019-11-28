<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksReaderRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_reader_rating', function (Blueprint $table) {
            $table->integer('book_id')->references('id')->on('books_book')->onDelete('CASCADE');
            $table->integer('reader_id')->references('id')->on('books_reader_profile')->onDelete('CASCADE');
            $table->integer('rating');
            $table->primary(['book_id', 'reader_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books_reader_rating');
    }
}
