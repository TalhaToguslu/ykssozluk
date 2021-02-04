<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\messageModel;

class adminMessageController extends Controller
{
  //MAİLLER
  public function mail(){
    $message=messageModel::paginate(20);
    return view("Back/dashboard")->with("message",$message);
  }

  //MAİL SİL
  public function mailDelete(Request $request){
    messageModel::where("id",$request->messageId)->delete();
    $message=messageModel::paginate(20);
    return redirect("/admin/mail")->with("message",$message);
  }
}
