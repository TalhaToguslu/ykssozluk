<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\userFollowModel;

class userController extends Controller
{
  //KULLANICI TAKİP ET
  public function userFollow(Request $request){
    $follow = new userFollowModel;
    $follow->follower_id = $request->followerId;
    $follow->user_id = $request->userId;
    $follow->created_at = now();
    $follow->save();
  }

  //KULLANICIYI TAKİBİ BIRAK
  public function userUnfollow(Request $request){
    userFollowModel::where(["follower_id"=>$request->followerId,"user_id"=>$request->userId])->delete();
    userFollowModel::onlyTrashed()->where(["follower_id"=>$request->followerId,"user_id"=>$request->userId])->forceDelete();
  }
}
