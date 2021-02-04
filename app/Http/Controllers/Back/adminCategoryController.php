<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\categoryModel;

class adminCategoryController extends Controller
{
  //KATEGORİLER
  public function category(){
    $category=categoryModel::paginate(20);
    return view("Back/dashboard")->with("category",$category);
  }

  //KATEGORİ ARA
  public function categorySearch(Request $request){
      $category=categoryModel::where('name', 'like', "%$request->name%")->paginate(20);

      return view("Back/dashboard")->with("category",$category)->with("categorySearch",$request->name);
  }

  //KATEGORİ DÜZENLE
  public function categoryUpdate(Request $request){
      categoryModel::where("id",$request->cat_id)->update(["name"=>$request->name]);
      $category=categoryModel::paginate(20);
      return redirect('/admin/category')->with("category",$category);
  }

  //KATEGORİ Sil
  public function categoryDelete(Request $request){
      categoryModel::where("id",$request->catId)->delete();
      $category=categoryModel::paginate(20);
      return redirect('/admin/category')->with("category",$category);
  }

  //KATEGORİ OLUŞTUR
  public function categoryCreate(Request $request){
      $data = new categoryModel;
      $data->name=$request->name;
      $data->save();

    $category=categoryModel::paginate(20);
    return redirect('/admin/category')->with("category",$category);
  }
}
