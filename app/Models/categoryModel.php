<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categoryModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table="category";

    public function getTitle(){
      return $this->hasMany('App\Models\titleModel',"category","id");
    }
}
