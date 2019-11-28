<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksPublisherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_publisher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200);
            $table->string('slug', 200)->unique()->index();
            $table->string('country',100);
            $table->string('city',100);
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
        Schema::dropIfExists('books_publisher');
    }
}
