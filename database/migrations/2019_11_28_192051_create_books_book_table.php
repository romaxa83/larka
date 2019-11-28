<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_book', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug', 100)->unique()->index();
            $table->text('description')->nullable();
            $table->string('lang',20);
            $table->integer('pages');
            $table->integer('amount')->default(0)->comment('Общее кол-во книг');
            $table->integer('amount_current')->default(0)->comment('Кол-во книг которое присутствует на дпнный момент');
            $table->integer('rating')->default(0);
            $table->integer('count_read')->default(0)->comment('Кол-во взятий для чтения');
            $table->integer('category_id')->references('id')->on('books_category');
            $table->integer('author_id')->references('id')->on('books_author');
            $table->integer('image_id')->references('id')->on('image');
            $table->integer('publisher_id')->references('id')->on('books_publisher');
            $table->date('published_date');
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
        Schema::dropIfExists('books_book');
    }
}
