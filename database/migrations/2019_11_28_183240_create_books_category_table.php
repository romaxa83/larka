<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksCategoryTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('books_category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('slug', 100)->unique()->index();
            $table->integer('parent_id')->nullable()->references('id')->on('regions')->onDelete('CASCADE');
            $table->integer('position')->default(0);
            $table->boolean('status');
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
        Schema::dropIfExists('books_category');
    }
}
