<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_store', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',150);
            $table->string('slug',150)->unique()->index();
            $table->string('city',150);
            $table->string('lng');
            $table->string('lat');
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
        Schema::dropIfExists('books_store');
    }
}
