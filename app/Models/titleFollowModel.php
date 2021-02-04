<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class titleFollowModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table="titlefollow";

    public function getTitle(){
      return $this->hasOne('App\Models\titleModel',"id","title_id");
    }
}
