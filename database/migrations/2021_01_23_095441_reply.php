<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Reply extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {/*
      Schema::create('reply', function (Blueprint $table) {
          $table->id();
          $table->string("entry_id");
          $table->longText("content");
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
