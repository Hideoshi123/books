<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('author_id')->unsigned();
            $table->string('title');
            $table->integer('stock');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('author_id')->references('id')->on('authors')->onDelete('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
