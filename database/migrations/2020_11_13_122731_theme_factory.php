<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ThemeFactory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('theme_name');
            $table->string('theme_link');
            $table->bigInteger('chapter')->unsigned();
            $table->bigInteger('technology')->unsigned();
            $table->foreign('chapter')->references('id')->on('chapters');
            $table->foreign('technology')->references('id')->on('technologies');
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
