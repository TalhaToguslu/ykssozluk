<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class replyModel extends Model
{
  use HasFactory;
  use SoftDeletes;
  public $table="reply";

  public function getUser(){
    return $this->hasOne("App\Models\User","id","user_id");
  }
  
}
