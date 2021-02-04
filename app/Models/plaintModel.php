<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class plaintModel extends Model
{
  use HasFactory;
  use SoftDeletes;
  public $table="plaint";

  public function getTitle(){
    return $this->hasOne('App\Models\titleModel',"id","type_id");
  }

  public function getEntry(){
    return $this->hasOne('App\Models\entryModel',"id","type_id");
  }

  public function getReply(){
    return $this->hasOne('App\Models\replyModel',"id","type_id");
  }
}
