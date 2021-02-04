<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\entryModel;

class adminEntryController extends Controller
{
  //ENTRYLER
  public function entry($category){
    $entry = entryModel::where("title_id",$category)->paginate(20);
    return view("Back/dashboard")->with("entry",$entry)->with("titleIdSearch",$category);
  }

  //TÜM ENTRYLER
  public function allEntry(){
    $allEntry = entryModel::paginate(20);
    return view("Back/dashboard")->with("allEntry",$allEntry);
  }

  //TÜM ENTRY Sil
  public function allEntryDelete(Request $request){
      entryModel::where("id",$request->entryId)->delete();
      $allEntry = entryModel::paginate(20);
      return redirect("/admin/entry")->with("allEntry",$allEntry);
  }

  // TÜM ENTRY ARA
  public function allEntrySearch(Request $request){
    $allEntry=entryModel::where('content', 'like', "%$request->name%")->paginate(20);
    return view("Back/dashboard")->with("allEntry",$allEntry)->with("entrySearch",$request->name);
  }

  //TÜM ENTRY GÜNCELLE
  public function allEntryUpdate(Request $request){;
    $request->validate([
      'article' => 'required',
      'entry_id'=> 'required'
    ]);
    $data = entryModel::findOrFail($request->entry_id);
    $data->content = $request->article;
    $data->save();

    $allEntry = entryModel::paginate(20);
    return redirect("/admin/entry")->with("allEntry",$allEntry);
  }

  //ENTRY GÜNCELLE
  public function entryUpdate(Request $request){;
    $request->validate([
      'article' => 'required',
      'entry_id'=> 'required'
    ]);
    $data = entryModel::findOrFail($request->entry_id);
    $data->content = $request->article;
    $data->save();

    $entry = entryModel::where("title_id",$request->title_name)->paginate(20);
    return redirect("/admin/entry/$request->title_name")->with("entry",$entry)->with("titleIdSearch",$request->title_name);
  }

  //ENTRY Sil
  public function entryDelete(Request $request){
      entryModel::where("id",$request->entryId)->delete();
      $entry = entryModel::where("title_id",$request->title_name)->paginate(20);
      return redirect("/admin/entry/$request->title_name")->with("entry",$entry)->with("titleIdSearch",$request->title_name);
  }

  //ENTRY ARA
  public function entrySearch(Request $request){
    $entry=entryModel::where('content', 'like', "%$request->name%")->paginate(20);
    return view("Back/dashboard")->with("entry",$entry)->with("entrySearch",$request->name)->with("titleIdSearch",$request->titleId);
  }
}
