@section('title',"Kullanıcı: ".$user->name)
<x-app-layout>
    <x-slot name="header">
            {{ __('Yazılarım') }}
    </x-slot>

    <div class="p-2 mx-auto w-12/12 sm:w-10/12 contanier rounded">

      <!-- PROFİL FOTOĞRAFI -->
      <input type="file" class="hidden"
                  wire:model="photo"
                  x-ref="photo"
                  x-on:change="
                          photoName = $refs.photo.files[0].name;
                          const reader = new FileReader();
                          reader.onload = (e) => {
                              photoPreview = e.target.result;
                          };
                          reader.readAsDataURL($refs.photo.files[0]);
                  " />

      <x-jet-label for="photo" value="{{ __('') }}" />

      <!-- PROFİL FOTOĞRAFI -->
      <div class="shadow-xl mt-2 bg-white rounded p-2 flex" x-show="! photoPreview">
          <a href=""><img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="m-2 rounded-full h-20 w-20 object-cover"></a>
          <h1 class="text-blue-400 w-full break-words my-auto text-sm sm:text-lg ml-1"><a class="mx-2" href="">{{ $user->name }}</a>
          @if(Auth::Check())
            @if ($user->id != Auth::user()->id)
              <button id="userFol" class="@isset($follow) hidden @else block @endisset m-1 my-auto bg-blue-400 rounded text-white p-1 text-sm float-right">
                <i class="fas fa-user-plus"></i> Takip Et
              </button>
              <button id="userUnf" class="@isset($follow) block @else hidden @endisset m-1 my-auto bg-blue-400 rounded text-white p-1 text-sm float-right">
                <i class="fas fa-user-minus"></i> Takipten Çık
              </button>
            @endif
          @endif
          </h1>

      </div>
      <!-- PROFİL FOTOĞRAFI SON-->

      <div class="my-5 p-2 overflow-y-auto grid grid-cols-2">
        <!-- TAKİP ETTİĞİ KULLANICILAR -->
        <div class="col-span-1 m-0.5 h-100 break-words">
          <h1 class="text-white mb-2 bg-blue-400 rounded p-2 sm:text-lg">@if(Auth::check()) @if($user->id == Auth::user()->id)Takip Ettiğin Kullanıcılar @else Takip Ettiği Kullanıcılar @endif @else Takip Ettiği Kullanıcılar @endif</h1>
            @foreach ($userFollow as $key => $value)
              @isset($value->getUser->name)
                <a href="{{route('myArticles',$value->getUser->name)}}">
                  <div class="bg-white p-1 rounded my-0.5 text-blue-400">
                      {{$value->getUser->name}}
                  </div>
                </a>
              @endisset
            @endforeach
        </div>
        <!-- TAKİP ETTİĞİ KULLANICILAR SON -->
        <!-- TAKİP ETTİĞİ BAŞLIKLAR -->
        <div class="col-span-1 m-0.5 h-100 break-words">
          <h1 class="text-white mb-2 bg-blue-400 rounded p-2 sm:text-lg">@if(Auth::check()) @if($user->id == Auth::user()->id)Takip Ettiğin Başlıklar @else Takip Ettiği Başlıklar @endif @else Takip Ettiği Başlıklar @endif</h1>
            @foreach ($titleFollow as $key => $value)
              @isset($value->getTitle)
              <a href="{{route('show',$value->getTitle->slug)}}">
                <div class="bg-white p-1 rounded my-0.5 text-blue-400">
                  {{$value->getTitle->title}}
                </div>
              </a>
              @endisset
            @endforeach
        </div>
        <!-- TAKİP ETTİĞİ BAŞLIKLAR SON -->
      </div>

      <!-- KULLANICI BAŞLIKLARI -->
      <div class="my-5 p-2 overflow-y-auto break-words">
        @if ($errors->any())
          <div class="bg-red-700 text-white rounded block p-2 m-2 shadow-xl">
              <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
        @isset($success1)
          <div class="p-2 m-2 bg-green-600 rounded shadow-xl text-white">
            {{$success1}}
          </div>
        @endisset
        <h1 class="text-white mb-2 bg-blue-400 rounded p-2 sm:text-lg">@if(Auth::check()) @if($user->id == Auth::user()->id)Başlıklarım ( {{count($titles)}} ) @else Başlıkları ( {{count($titles)}} ) @endif @else Başlıkları ( {{count($titles)}} ) @endif</h1>
        @foreach ($titles as $key => $value)
          <div x-data="{ show: false }">
          @if(Auth::check())
            @if ($value->user_id == Auth::user()->id)
              <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="p-2 m-1 rounded shadow-xl float-right bg-blue-400 text-white"><i class="fas fa-pen"></i></button>
            @endif
          @endif
            <div class="align-middle p-1 mt-1 bg-white rounded">
              <a class="m-1" href="{{route('show',$value->slug)}}">
                <h1 class="text-blue-400 text-base rounded break-words">{{$value->title}}<span class=" bg-green-600 px-2 ml-4 text-white rounded shadow-xl">{{$value->count}}</span></h1>
              </a>
            </div>
          @if(Auth::check())
            @if ($value->user_id==Auth::user()->id)
          <div x-show.transition="show" class="shadow my-2 bg-blue-400 rounded">
            <form method="post" action="{{route('titleUpdate')}}">
              @csrf
              <input type="hidden" name="title_id" value="{{$value->id}}">
              <label class="block shadow-xl p-2 mx-2 rounded">
                <input name="title" maxlength="40" required class="form-input mt-1 rounded p-3 block w-full" value="{{$value->title}}" placeholder="Başlık">
              </label>
              <label class="block shadow-xl mx-4 mt-2">
                <span class="text-white">Ne Hakkında?</span>
                <select name="category" required class="form-select rounded block w-full mt-1">
                  <option value="">...</option>
                  @foreach ($category as $key => $values)
                    <option @if($value->category == $values->id) selected  @endif value="{{$values->id}}">{{$values->name}}</option>
                  @endforeach
                </select>
              </label>
              <label class="block shadow-xl p-2 m-2">
                <textarea style="resize:none;" maxlength="3000" required name="article" class="form-input mt-1 rounded p-3 block w-full" rows="6" placeholder="Yorumunuz">{{$value->content}}</textarea>
              </label>
              <label class="block p-2">
                <input type="submit" name="postBtn" value="Sil" class="bg-red-600 w-3/12 p-2 rounded text-white shadow-xl">
                <input type="submit" name="postBtn" value="Kaydet" class="bg-green-600 w-3/12 p-2 rounded text-white shadow-xl">
              </label>
            </form>
          </div>
          @endif
        @endif
        </div>
        @endforeach
      </div>
      <!-- KULLANICI BAŞLIKLARI SON -->

      <!-- KULLANICI ENTRYLERİ -->
      <div class="max-h-100 my-5 p-2 overflow-y-auto break-words">
            @isset($success)
              <div class="p-2 m-2 bg-green-600 rounded shadow-xl text-white">
                {{$success}}
              </div>
            @endisset
        <h1 class="text-white mb-2 bg-blue-400 rounded p-2 sm:text-lg">@if(Auth::check()) @if($user->id == Auth::user()->id)Entrylerim ( {{count($entry)}} ) @else Entryleri ( {{count($entry)}} ) @endif @else Entryleri ( {{count($entry)}} ) @endif</h1>
        @foreach ($entry as $key => $value)
        <div x-data="{ show: false }">
        @if(Auth::check())
          @if ($value->user_id==Auth::user()->id)
            <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="p-2 m-1 rounded shadow-xl float-right bg-blue-400 text-white"><i class="fas fa-pen"></i></button>
          @endif
        @endif
          <div class="align-middle p-1 mt-1 bg-white rounded">
            <a class="m-1" @isset($value->getTitle) href="{{route('show',$value->getTitle->slug)}}" @else href="{{route('show',1)}}"  @endisset>
              <p class="text-blue-400 text-base rounded break-words">{{$value->content}}<span class="bg-green-600 text-white px-2 ml-4 rounded shadow-xl">@isset($value->getTitle) {{$value->getTitle->title}} @else Bulunamadı @endisset</span></p>
            </a>

          </div>
        @if(Auth::check())
          @if ($value->user_id==Auth::user()->id)
          <div x-show.transition="show" class="my-2 shadow bg-blue-400 rounded">
            <form method="post" action="{{route('entryUpdate')}}">
              @csrf
              <input type="hidden" name="title_id" value="{{$value->id}}">
              <label class="block shadow-xl p-2 m-2">
                <textarea style="resize:none;" maxlength="3000" required name="article" class="form-input mt-1 rounded p-3 block w-full" rows="6" placeholder="Yorumunuz">{{$value->content}}</textarea>
              </label>
              <label class="block mx-2">
                <input type="submit" name="postBtn" value="Sil" class="bg-red-600 my-2 w-3/12 p-2 rounded text-white shadow-xl">
                <input type="submit" name="postBtn" value="Kaydet" class="bg-green-600 my-2 w-3/12 p-2 rounded text-white shadow-xl">
              </label>
            </form>
          </div>
          @endif
        @endif
        </div>
        @endforeach
        <div class="mt-2">
          {{$entry->links()}}
        </div>
      </div>
      <!-- KULLANICI ENTRYLERİ SON -->

    </div>

</x-app-layout>

<!-- FOOTER-->
@include('layouts/footer')
<!-- FOOTER SON-->

<script>
$(document).ready(function(){

  //TAKİP ET BUTONU
  $( "#userFol" ).click(function(){
    //VERİ POST KISMI
    userId = {{$user->id}};
    followerId = @if(Auth::check()) {{Auth::user()->id}}; @else 0; @endif
    $.get("{{route('userFollow')}}",{ userId:userId , followerId:followerId }, function(data, status){
      console.log(data);
    });

    //BUTTON GÖRÜNÜRLÜK KISMI
      //takip butonunu gizle
    $(this).removeClass("block");
    $(this).addClass("hidden");
      //takipten çıkar butonunu görünür yap
    $("#userUnf").removeClass("hidden");
    $("#userUnf").addClass("block");

  });

  //TAKİPTEN ÇIKAR BUTONU
  $( "#userUnf" ).click(function() {
    //VERİ POST KISMI
    userId = {{$user->id}};
    followerId = @if(Auth::check()) {{Auth::user()->id}}; @else 0; @endif
    $.get("{{route('userUnfollow')}}",{ userId:userId , followerId:followerId }, function(data, status){
      console.log(data);
    });
    //BUTTON GÖRÜNÜRLÜK KISMI
      //takip butonunu gizle
    $(this).removeClass("block");
    $(this).addClass("hidden");
      //takipten çıkar butonunu görünür yap
    $("#userFol").removeClass("hidden");
    $("#userFol").addClass("block");
  });


});
</script>
