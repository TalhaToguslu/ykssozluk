<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\entryModel;
use App\Models\titleModel;
use App\Models\User;
use App\Models\replyModel;
use App\Models\footerModel;
use App\Models\messageModel;

class DashboardController extends Controller
{
    //TOPLAM KULLANICI,BAŞLIK VS.
    public function index(){
      $footer=footerModel::first();
      $countUser=User::get()->count();
      $countTitle=titleModel::get()->count();
      $countEntry=entryModel::get()->count();
      $countReply=replyModel::get()->count();

      return view("Back/dashboard")->with("countUser",$countUser)
      ->with("countTitle",$countTitle)->with("countEntry",$countEntry)->with("countReply",$countReply)->with("footer",$footer);
    }

}
