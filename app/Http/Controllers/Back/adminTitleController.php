<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\titleModel;
use App\Models\categoryModel;

class adminTitleController extends Controller
{
  //BAŞLIKLAR
  public function titles(){
    $titles=titleModel::paginate(20);
    return view("Back/dashboard")->with("titles",$titles);
  }

  //BAŞLIK ARA
  public function titleSearch(Request $request){
      $titles=titleModel::where('title', 'like', "%$request->name%")->paginate(20);
      return view("Back/dashboard")->with("titles",$titles)->with("titleSearch",$request->name);
  }

  //BAŞLIK GÜNCELLE
  public function titleUpdate(Request $request){

      $request->validate([
        'title' => 'min:5 | required | unique:title',
        'article' => 'required',
        'title_id'=> 'required'
      ]);

      $data = titleModel::findOrFail($request->title_id);
      $data->title = $request->title;
      $data->slug=Str::slug($request->title,"-");
      $data->content = $request->article;
      $data->upt=now();
      $data->save();

      $titles=titleModel::paginate(20);
      return redirect("/admin/titles")->with("titles",$titles);

  }

  //BAŞLIK Sil
  public function titleDelete(Request $request){
      titleModel::where("id",$request->titleId)->delete();
      $category=categoryModel::paginate(20);
      return redirect('/admin/titles')->with("category",$category);
  }
}
