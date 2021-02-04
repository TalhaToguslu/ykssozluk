<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\entryModel;

class titleModel extends Model
{
  use HasFactory;
  use SoftDeletes;
  public $table="title";

  public function getUser(){
    return $this->hasOne("App\Models\User","id","user_id");
  }

  public function getEntry(){
    return $this->hasMany('App\Models\entryModel',"title_id","id");
  }

  public function getCategory(){
    return $this->hasOne("App\Models\categoryModel","id","category");
  }
}
