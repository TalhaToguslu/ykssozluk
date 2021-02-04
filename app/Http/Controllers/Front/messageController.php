<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Models\messageModel;

class messageController extends Controller
{
  //İLETİŞİM MESAJ KAYIT
  public function message(Request $request){
    $message = new messageModel;
    $message->email=$request->email;
    $message->konu=$request->title;
    $message->message=$request->message;
    $message->save();

    return redirect('/forum/info')->with('status', 'Mesajınız iletildi.');
  }
}
