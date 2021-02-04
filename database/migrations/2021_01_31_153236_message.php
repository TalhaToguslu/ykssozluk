<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Message extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
      Schema::create('message', function (Blueprint $table) {
          $table->id();
          $table->string("email");
          $table->string("konu");
          $table->string("message");
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
