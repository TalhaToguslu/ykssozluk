<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class entryModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table="entry";

    public function getTitle(){
      return $this->hasOne('App\Models\titleModel',"id","title_id");
    }

    public function getUser(){
      return $this->hasOne("App\Models\User","id","user_id");
    }

    public function getReply(){
      return $this->hasMany('App\Models\replyModel',"entry_id","id");
    }
}
