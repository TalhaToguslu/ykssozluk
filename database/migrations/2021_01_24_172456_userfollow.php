<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Userfollow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
      Schema::create('userfollow', function (Blueprint $table) {
          $table->id();
          $table->string("user_id");
          $table->string("follower_id");
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
