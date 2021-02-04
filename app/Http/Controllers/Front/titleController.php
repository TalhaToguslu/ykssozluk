<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\titleFollowModel;
use App\Models\entryModel;
use App\Models\titleModel;
use App\Models\User;
use App\Models\userFollowModel;
use App\Models\categoryModel;
use App\Models\footerModel;

class titleController extends Controller
{

  //BAŞLIK OLUŞTURMA
  public function create(Request $request){

    $request->validate([
      'title' => 'min:5 | required | unique:title',
      'category' => 'required',
      'article' => 'min:10 | required'
    ]);

    //başlığı kaydetme
    $title = new titleModel;
    $title->user_id=Auth::user()->id;
    $title->content=$request->article;
    $title->title=$request->title;
    $title->category=$request->category;
    $title->count=0;
    $title->slug=Str::slug($request->title,"-");
    $title->created_at=now();
    $title->save();

    return redirect('/forum');

  }
  //BAŞLIK OLUŞTURMA SON

  //BAŞLIK DÜZENLEME-SİLME
  public function titleUpdate(Request $request){

    if($request->postBtn == "Sil"){//SİL İSE

      titleModel::find($request->title_id)->delete() ?? abort(403, 'Böyle bir başlık bulunamadı.');
      $userData=User::where("id",Auth::user()->id)->first() ?? abort(403, 'Böyle bir yazar bulunamadı.');

      return redirect("/user/$userData->name");

    }else{//KAYDET İSE

      $request->validate([
        'title' => 'min:5 | required | unique:title',
        'article' => 'required',
        'title_id'=> 'required'
      ]);

      $data = titleModel::findOrFail($request->title_id);
      $data->title = $request->title;
      $data->category=$request->category;
      $data->slug=Str::slug($request->title,"-");
      $data->content = $request->article;
      $data->upt=now();
      $data->save();

      $userData=User::where("id",Auth::user()->id)->first() ?? abort(403, 'Böyle bir yazar bulunamadı.');

      return redirect("/user/$userData->name");

    }

  }

  //BAŞLIK TAKİP ET
  public function titleFollow(Request $request){
    $follow = new titleFollowModel;
    $follow->title_id = $request->titleId;
    $follow->user_id = $request->userId;
    $follow->created_at = now();
    $follow->save();
  }

  //BAŞLIK TAKİBİ BIRAK
  public function titleUnfollow(Request $request){
    titleFollowModel::where(["title_id"=>$request->titleId,"user_id"=>$request->userId])->delete();
    titleFollowModel::onlyTrashed()->where(["title_id"=>$request->titleId,"user_id"=>$request->userId])->forceDelete();
  }
}
