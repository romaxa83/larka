<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksReaderProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_reader_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->boolean('status')->default(true);
            $table->date('birthday')->nullable();
            $table->date('date_last_visit');
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
        Schema::dropIfExists('books_reader_profile');
    }
}
