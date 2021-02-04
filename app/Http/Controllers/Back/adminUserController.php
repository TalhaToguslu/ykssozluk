<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\User;

class adminUserController extends Controller
{
  //KULLANICILAR
  public function users(){
      $users=User::paginate(20);
      return view("Back/dashboard")->with("users",$users);
  }

  //KULLANICILAR ARA
  public function userSearch(Request $request){
      $users=User::where('name', 'like', "%$request->name%")->paginate(20);
      return view("Back/dashboard")->with("users",$users)->with("userSearch",$request->name);
  }

  //KULLANICI YONETİCİ YAP-ÇIKAR
  public function userType(Request $request){
    if($request->change == "1"){
      User::where("id",$request->userId)->update(["admin"=>1]);
    }else{
      User::where("id",$request->userId)->update(["admin"=>0]);
    }
  }

  //KULLANICI Sİl
  public function userDelete(Request $request){
    User::where("id",$request->userId)->delete();
  }
}
