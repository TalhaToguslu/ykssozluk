<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\plaintModel;

class plaintController extends Controller
{

      //ŞİKAYET KAYIT
      public function plaint(Request $request){
        $control=plaintModel::where(["type"=>$request->type,"type_id"=>$request->id])->first();
        if(isset($control)){
          $indis = $control->count;
          $indis++;
          plaintModel::where(["type"=>$request->type,"type_id"=>$request->id])->update(["count"=>$indis]);
        }else{
          $data = new plaintModel;
          $data->type=$request->type;
          $data->user_id=0;
          $data->type_id=$request->id;
          $data->created_at=now();
          $data->count=1;
          $data->save();
        }
      }
}
