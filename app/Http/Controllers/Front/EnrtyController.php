<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

use App\Models\entryModel;
use App\Models\titleModel;
use App\Models\User;
use App\Models\replyModel;
use App\Models\plaintModel;
use App\Models\titleFollowModel;
use App\Models\userFollowModel;
use App\Models\categoryModel;
use App\Models\footerModel;
use App\Models\entrylikesModel;
use App\Models\entrydislikesModel;
use App\Models\replylikesModel;
use App\Models\replydislikesModel;

class EnrtyController extends Controller
{

    //ENTRY GÖRÜNTÜLEME
    public function show($slug){
      //footer
      $footer=footerModel::first();
      //Kategoriler
      $category=categoryModel::get();
      $title = titleModel::where("slug",$slug)->first() ?? abort(403, 'Böyle bir başlık bulunamadı.');
      $entry = entryModel::where("title_id",$title->id)->paginate(12);

      if(Auth::check()){
        $follow= titleFollowModel::where(["user_id"=>Auth::user()->id,"title_id"=>$title->id])->first();
        return view("Front/entry")->with("footer",$footer)->with("title",$title)->with("entry",$entry)->with("category",$category)->with("follow",$follow);
      }else{
        return view("Front/entry")->with("footer",$footer)->with("title",$title)->with("entry",$entry)->with("category",$category);
      }

    }
    //ENTRY GÖRÜNTÜLEME SON

    //ENTRY KAYIT
    public function createComment(Request $request){
      $request->validate([
        'comment' => 'min:5 | required',
      ]);

      //YORUMUN KAYDEDİLMESİ
      $comment = new entryModel;
      $comment->user_id = Auth::user()->id;
      $comment->title_id = $request->title_id;
      $comment->content = $request->comment;
      $comment->created_at = now();
      $comment->save();

      //  count u 1 arttırma
      $data = titleModel::findOrFail($request->title_id);
      $i = $data->count;
      $i++;
      $data->count=$i;
      $data->save();

      //SLUG VERİSİNİN GETİRİLMESİ
      $slug=titleModel::where("id",$request->title_id)->first() ?? abort(403, 'Böyle bir başlık bulunamadı.');

      return redirect("entry/$slug->slug");
    }
    //ENTRY KAYIT SON

    //ENTRY DÜZENLEME-SİLME
    public function entryUpdate(Request $request){
      if($request->postBtn == "Sil"){//SİL İSE
        //BAŞLIK SAYACINI DÜŞÜRME
        $deleteEntry = entryModel::where("id",$request->title_id)->first() ?? abort(403, 'Böyle bir entry bulunamadı.');
        $sayac = titleModel::where("id",$deleteEntry->title_id)->first();

        if($sayac != null){
          $indis = $sayac->count-1;
          titleModel::where("id",$deleteEntry->title_id)->update(["count"=>$indis]);
        }

        entryModel::find($request->title_id)->delete() ?? abort(403, 'Böyle bir entry bulunamadı.');
        $userData=User::where("id",Auth::user()->id)->first() ?? abort(403, 'Böyle bir yazar bulunamadı.');

        return redirect("/user/$userData->name");

      }else{//KAYDET İSE

        $request->validate([
          'article' => 'required'
        ]);

        $data = entryModel::findOrFail($request->title_id);
        $data->content = $request->article;
        $data->upt = now();
        $data->save();

        $userData=User::where("id",Auth::user()->id)->first() ?? abort(403, 'Böyle bir yazar bulunamadı.');

        return redirect("/user/$userData->name");
      }

    }

    //ENTRY CEVAP VERME
    public function createReply(Request $request){

      $request->validate([
        'entry_id' => 'required',
        'comment' => 'required'
      ]);

      //CEVABI KAYDETME
      $reply = new replyModel;
      $reply->user_id=Auth::user()->id;
      $reply->entry_id=$request->entry_id;
      $reply->content=$request->comment;
      $reply->created_at=now();
      $reply->save();

      $title = titleModel::where("id",$request->title_id)->first();

      return redirect("entry/$title->slug");
    }

    public function entryLike(Request $request){
      //KULLANICI GİRİŞİ VAR İSE
      if(Auth::check()){
        $kontrol = entrylikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
        //DAHA ÖNCE BEĞENMEMİŞ Mİ KONTROL
        if(isset($kontrol)){
        }else{
          //BEĞENMEME TABLOSUNDA VARMI
          $dislikeskontrol = entrydislikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
          //VARSA KALDIR
          if(isset($dislikeskontrol)){
            entrydislikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->delete();
          }
          //BEĞENMEMİŞSE
          $data = new entrylikesModel;
          $data->entry_id=$request->id;
          $data->user_id=Auth::user()->id;
          $data->save();
        }
      }
    }

    public function entrydisLike(Request $request){
      //KULLANICI GİRİŞİ VAR İSE
      if(Auth::check()){
        $kontrol = entrydislikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
        //DAHA ÖNCE BEĞENMEMİŞ Mİ KONTROL
        if(isset($kontrol)){
        }else{
          //BEĞENME TABLOSUNDA VARMI
          $likeskontrol = entrylikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
          //VARSA SİL
          if(isset($likeskontrol)){
            entrylikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->delete();
          }
          //BEĞENMEMİŞSE
          $data = new entrydislikesModel;
          $data->entry_id=$request->id;
          $data->user_id=Auth::user()->id;
          $data->save();
        }
      }
    }

    public function replyLike(Request $request){
      //KULLANICI GİRİŞİ VAR İSE
      if(Auth::check()){
        $kontrol = replylikesModel::where(["reply_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
        //DAHA ÖNCE BEĞENMEMİŞ Mİ KONTROL
        if(isset($kontrol)){
        }else{
          //BEĞENMEME TABLOSUNDA VARMI
          $dislikeskontrol = replydislikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
          //VARSA KALDIR
          if(isset($dislikeskontrol)){
            replydislikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->delete();
          }
          //BEĞENMEMİŞSE
          $data = new replylikesModel;
          $data->reply_id=$request->id;
          $data->user_id=Auth::user()->id;
          $data->save();
        }
      }
    }

    public function replydisLike(Request $request){
      //KULLANICI GİRİŞİ VAR İSE
      if(Auth::check()){
        $kontrol = replydislikesModel::where(["entry_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
        //DAHA ÖNCE BEĞENMEMİŞ Mİ KONTROL
        if(isset($kontrol)){
        }else{
          //BEĞENME TABLOSUNDA VARMI
          $likeskontrol = replylikesModel::where(["reply_id"=>$request->id,"user_id"=>Auth::user()->id])->first();
          //VARSA SİL
          if(isset($likeskontrol)){
            replylikesModel::where(["reply_id"=>$request->id,"user_id"=>Auth::user()->id])->delete();
          }
          //BEĞENMEMİŞSE
          $data = new replydislikesModel;
          $data->entry_id=$request->id;
          $data->user_id=Auth::user()->id;
          $data->save();
        }
      }
    }



}
