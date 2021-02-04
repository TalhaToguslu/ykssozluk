<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\entryModel;
use App\Models\titleModel;
use App\Models\User;
use App\Models\userFollowModel;
use App\Models\titleFollowModel;
use App\Models\categoryModel;
use App\Models\footerModel;

class ForumController extends Controller
{
    //FORUM ANASAYFAYA GİTME
    public function index(){
      //footer
      $footer=footerModel::first();
      //Kategoriler
      $category=categoryModel::get();
      //TOP 10 BAŞLIK
      $titles=titleModel::orderBy("count","desc")->paginate(12);
      return view('Front/forum')->with("titles",$titles)->with("category",$category)->with("footer",$footer)->with("journal","1");
    }

    //FORUM ANASAYFAYA EN YENİLER
    public function newIndex(){
      //footer
      $footer=footerModel::first();
      //Kategoriler
      $category=categoryModel::get();
      //TOP 10 BAŞLIK
      $titles=titleModel::orderBy("created_at","desc")->paginate(12);
      return view('Front/forum')->with("titles",$titles)->with("category",$category)->with("footer",$footer)->with("new","1");
    }

    //KULLANICI YAZILARINA GİTME
    public function myArticles($user){
      //footer
      $footer=footerModel::first();
      $userData=User::where("name",$user)->first() ?? abort(403, 'Böyle bir yazar bulunamadı.');
      $titles=titleModel::where("user_id",$userData->id)->get();
      $entry=entryModel::where("user_id",$userData->id)->paginate(12);
      $userFollow=userFollowModel::where("follower_id",$userData->id)->get();
      $titleFollow=titleFollowModel::where("user_id",$userData->id)->get();
      if(Auth::check()){
        $category=categoryModel::get();
        $follow=userFollowModel::where(["user_id"=>$userData->id,"follower_id"=>Auth::user()->id])->first();
        return view('Front/myArticles')->with("footer",$footer)->with("category",$category)->with("titles",$titles)->with("entry",$entry)->with("user",$userData)->with("follow",$follow)->with("userFollow",$userFollow)->with("titleFollow",$titleFollow);
      }else{
        return view('Front/myArticles')->with("footer",$footer)->with("titles",$titles)->with("entry",$entry)->with("user",$userData)->with("userFollow",$userFollow)->with("titleFollow",$titleFollow);
      }
    }

    //KATEGORİ ANASAYFALARI
    public function category($slug){
      //footer
      $footer=footerModel::first();
      //Arama Kategoriler
      $category=categoryModel::get();
      //Kategorilerdeki Başlıklar
      $catName = categoryModel::where("name",$slug)->first() ?? abort(403, 'Böyle bir kategori bulunamadı.');
      $entrys=titleModel::where("category",$catName->id)->orderBy("count","desc")->paginate(12);
      return view('Front/categoryForum')->with("footer",$footer)->with("entrys",$entrys)->with("category",$category)->with("slug",$slug);
    }

    //HAKKIMIZDA VE İLETİŞİM

    public function info(){
      $footer=footerModel::first();
      return view('Front/aboutContact')->with("footer",$footer);
    }

    //BAŞLIK ARAMA
    public function search(Request $request){
      $footer=footerModel::first();
      //Arama Sonucu
      $titles=titleModel::where('title', 'like', "%$request->search%")->paginate(12);
     //Kategoriler
     $category=categoryModel::get();

     return view('Front/forum')->with("footer",$footer)->with("titles",$titles)->with("category",$category)->with("search",$request->search);
    }

}
