<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Titlefollow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
      Schema::create('titlefollow', function (Blueprint $table) {
          $table->id();
          $table->string("title_id");
          $table->string("user_id");
          $table->softDeletes();
          $table->timestamps();
      });*/
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
