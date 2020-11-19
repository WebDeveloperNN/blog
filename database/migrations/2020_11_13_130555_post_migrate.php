<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PostMigrate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post');
            $table->bigInteger('theme')->unsigned();
            $table->bigInteger('chapter')->unsigned();
            $table->bigInteger('technology')->unsigned();
            $table->foreign('chapter')->references('id')->on('chapters');
            $table->foreign('technology')->references('id')->on('technologies');
            $table->foreign('theme')->references('id')->on('themes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
