<?php

use Illuminate\Support\Facades\Route;
//FRONT CONTROLLER
use App\Http\Controllers\Front\ForumController;
use App\Http\Controllers\Front\EnrtyController;
use App\Http\Controllers\Front\messageController;
use App\Http\Controllers\Front\userController;
use App\Http\Controllers\Front\titleController;
use App\Http\Controllers\Front\plaintController;

//BACK CONTROLLER
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\adminUserController;
use App\Http\Controllers\Back\adminTitleController;
use App\Http\Controllers\Back\adminPlaintController;
use App\Http\Controllers\Back\adminCategoryController;
use App\Http\Controllers\Back\adminEntryController;
use App\Http\Controllers\Back\adminMessageController;
use App\Http\Controllers\Back\adminFooterController;

//MAİN ROUTE
Route::get('/',[ForumController::class,'index']);
Route::get('/new',[ForumController::class,'newIndex']);

//////////////////////////////
//FRONT ROUTE
//////////////////////////////
//kullanıcı takip-takipen çıkma
Route::middleware(['auth:sanctum', 'verified'])->get('/user/follow',[userController::class,'userFollow'])->name("userFollow");
Route::middleware(['auth:sanctum', 'verified'])->get('/user/unfollow',[userController::class,'userUnfollow'])->name("userUnfollow");
//başlık takip-takipen çıkma
Route::middleware(['auth:sanctum', 'verified'])->get('/title/unfollow',[titleController::class,'titleUnfollow'])->name("titleUnfollow");
Route::middleware(['auth:sanctum', 'verified'])->get('/title/follow',[titleController::class,'titleFollow'])->name("titleFollow");
//yorum yapma
Route::middleware(['auth:sanctum', 'verified'])->post('/entry/comment',[EnrtyController::class,'createReply'])->name("createReply");
//entry güncelleme
Route::middleware(['auth:sanctum', 'verified'])->post('/entry/update',[EnrtyController::class,'entryUpdate'])->name("entryUpdate");
//başlık güncelleme
Route::middleware(['auth:sanctum', 'verified'])->post('/title/update',[titleController::class,'titleUpdate'])->name("titleUpdate");
// entry beğenme
Route::get('/entry/like',[EnrtyController::class,'entryLike'])->name("entryLike");
// entry beğenmeme
Route::get('/entry/dislike',[EnrtyController::class,'entrydisLike'])->name("entrydisLike");
// yorum beğenme
Route::get('/reply/like',[EnrtyController::class,'replyLike'])->name("replyLike");
// yorum beğenmeme
Route::get('/reply/dislike',[EnrtyController::class,'replydisLike'])->name("replydisLike");
//şikayet
Route::get('/plaint',[plaintController::class,'plaint'])->name("plaint");
//arama
Route::get('/search',[ForumController::class,'search'])->name("search");
//kullanıcı yazıları +
Route::get('/user/{user}',[ForumController::class,'myArticles'])->name("myArticles");
//forum
Route::get('/forum',[ForumController::class,'index'])->name("Forum");
//hakkımızda
Route::get('/forum/info',[ForumController::class,'info'])->name("infoShow");
//kategori forum
Route::get('/forum/{slug}',[ForumController::class,'category'])->name("forumCategory");
//başlık forum
Route::get('/entry/{slug}',[EnrtyController::class,'show'])->name("show");
//mesaj kayıt
Route::post('/info/message',[messageController::class,'message'])->name("message");
//başlık oluşturma
Route::middleware(['auth:sanctum', 'verified'])->post('/create',[titleController::class,'create'])->name("create");
//entry oluşturma
Route::middleware(['auth:sanctum', 'verified'])->post('/comment/create',[EnrtyController::class,'createComment'])->name("createComment");

////////////////////////////////
//BACK ROUTE
////////////////////////////////
//DASHBOARD
Route::middleware("admin")->get('/admin/dashboard',[DashboardController::class,'index'])->name("adminDashboard");

//KULLANICI
//Kullanıcı dashboard
Route::middleware("admin")->get('/admin/users',[adminUserController::class,'users'])->name("adminUsers");
//Kullanıcı Arama
Route::middleware("admin")->get('/admin/users/search',[adminUserController::class,'userSearch'])->name("adminUsersSearch");
//Kullanıcı Yetkilendirme
Route::middleware("admin")->get('/admin/users/type',[adminUserController::class,'userType'])->name("adminUserType");
//Kullanıcı Silme
Route::middleware("admin")->get('/admin/users/delete',[adminUserController::class,'userDelete'])->name("adminUserDelete");

//BAŞLIK
// Başlık dashboard
Route::middleware("admin")->get('/admin/titles',[adminTitleController::class,'titles'])->name("adminTitle");
// Başlık arama
Route::middleware("admin")->get('/admin/titles/search',[adminTitleController::class,'titleSearch'])->name("adminTitleSearch");
// Başlık güncelleme
Route::middleware("admin")->get('/admin/titles/update',[adminTitleController::class,'titleUpdate'])->name("adminTitleUpdate");
// Başlık silme
Route::middleware("admin")->get('/admin/titles/delete',[adminTitleController::class,'titleDelete'])->name("adminTitleDelete");


//ŞİKAYETLER
// Şikayetler dashboard
Route::middleware("admin")->get('/admin/plaints',[adminPlaintController::class,'plaints'])->name("adminPlaints");
// Şikayet sil
Route::middleware("admin")->get('/admin/plaints/delete',[adminPlaintController::class,'plaintsDelete'])->name("adminPlaintsDelete");
// Şikayetler edileni sil
Route::middleware("admin")->get('/admin/plaints/delete/complain',[adminPlaintController::class,'complainDelete'])->name("adminComplainDelete");

//KATEGORİLER
// Kategori dashboard
Route::middleware("admin")->get('/admin/category',[adminCategoryController::class,'category'])->name("adminCategory");
// Kategori arama
Route::middleware("admin")->get('/admin/category/search',[adminCategoryController::class,'categorySearch'])->name("adminCategorySearch");
// Kategori güncelle
Route::middleware("admin")->get('/admin/category/update',[adminCategoryController::class,'categoryUpdate'])->name("adminCategoryUpdate");
// Kategori sil
Route::middleware("admin")->get('/admin/category/delete',[adminCategoryController::class,'categoryDelete'])->name("adminCategoryDelete");
// Kategori oluştur
Route::middleware("admin")->get('/admin/category/create',[adminCategoryController::class,'categoryCreate'])->name("adminCategoryCreate");

//ENTRYLER
//Tüm etryler
Route::middleware("admin")->get('/admin/entry',[adminEntryController::class,'allEntry'])->name("adminAllEntry");
//Tüm etryler sil
Route::middleware("admin")->get('/admin/all/entry/delete',[adminEntryController::class,'allEntryDelete'])->name("adminAllEntryDelete");
//Tüm etryler ara
Route::middleware("admin")->get('/admin/all/entry/search',[adminEntryController::class,'allEntrySearch'])->name("adminAllEntrySearch");
//Tüm etryler güncelle
Route::middleware("admin")->get('/admin/all/entry/update',[adminEntryController::class,'allEntryUpdate'])->name("adminAllEntryUpdate");
// entry dashboard
Route::middleware("admin")->get('/admin/entry/{category}',[adminEntryController::class,'entry'])->name("adminEntry");
// Entry ara
Route::middleware("admin")->get('/admin/entry/search',[adminEntryController::class,'entrySearch'])->name("adminEntrySearch");
// Entry sil
Route::middleware("admin")->get('/admin/entry/delete',[adminEntryController::class,'entryDelete'])->name("adminEntryDelete");
// Entry güncelle
Route::middleware("admin")->get('/admin/entry/update',[adminEntryController::class,'entryUpdate'])->name("adminEntryUpdate");

//FOOTER
// Footer güncelle
Route::middleware("admin")->get('/admin/footer/update',[adminFooterController::class,'footerUpdate'])->name("adminFooterUpdate");

//MAİLLER
// Maiiler dashboard
Route::middleware("admin")->get('/admin/mail',[adminMessageController::class,'mail'])->name("adminMail");
// Mail Sil
Route::middleware("admin")->get('/admin/mail/delete',[adminMessageController::class,'mailDelete'])->name("adminMailDelete");
