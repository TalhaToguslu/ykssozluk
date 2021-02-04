<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\entryModel;
use App\Models\titleModel;
use App\Models\replyModel;
use App\Models\plaintModel;

class adminPlaintController extends Controller
{
  //ŞİKAYETLER
  public function plaints(){
    $plaints=plaintModel::paginate(20);
    return view("Back/dashboard")->with("plaints",$plaints);
  }

  //ŞİKAYETİ SİL
  public function plaintsDelete(Request $request){
    plaintModel::where("id",$request->plaintId)->delete();
    $plaints=plaintModel::paginate(20);
    return redirect("/admin/plaints")->with("plaints",$plaints);
  }

  //ŞİKAYET EDİLENİ SİL
  public function complainDelete(Request $request){
    $data=plaintModel::where("id",$request->plaintId)->first();

    if($data->type=="başlık"){
      titleModel::where("id",$data->getTitle->id)->delete();
      plaintModel::where("id",$request->plaintId)->delete();
    }else if($data->type=="yorum"){
      entryModel::where("id",$data->getEntry->id)->delete();
      plaintModel::where("id",$request->plaintId)->delete();
    }else{
      replyModel::where("id",$data->getReply->id)->delete();
      plaintModel::where("id",$request->plaintId)->delete();
    }
    $plaints=plaintModel::paginate(20);
    return redirect("/admin/plaints")->with("plaints",$plaints);
  }
}
