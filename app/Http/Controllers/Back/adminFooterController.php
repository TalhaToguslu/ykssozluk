<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\footerModel;

class adminFooterController extends Controller
{

      //FOOTER LİNK KAYDET
      public function footerUpdate(Request $request){
        if(isset($request->insta)){
          footerModel::where("id","1")->update(["instagram"=>$request->insta]);
        }else if(isset($request->git)){
          footerModel::where("id","1")->update(["github"=>$request->git]);
        }else if(isset($request->link)){
          footerModel::where("id","1")->update(["linkedln"=>$request->link]);
        }else if(isset($request->hak)){
          footerModel::where("id","1")->update(["Hakkimizda"=>$request->hak]);
        }
        return $this->index();
      }
}
