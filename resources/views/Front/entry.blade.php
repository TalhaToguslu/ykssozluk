@section('title',$title->title)
<x-app-layout>
    <x-slot name="header">
            {{ __('Sözlük') }}
    </x-slot>

    <div class="contanier rounded">

      <!-- YKSSÖZLÜK ARAMA -->
      <div class="block sm:hidden m-2">
        @include('layouts/searchbar')
      </div>
      <!-- ARAMA SON -->

      @if ($errors->any())
        <div class="bg-red-700 text-white rounded block p-2 m-4 shadow-xl">
            <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif

      <div class="grid grid-cols-5 m-2 p-2">

        <div class="col-span-5 sm:col-span-4">
          <h1 class="text-xl rounded p-2 bg-blue-400 mx-2 mt-2 text-white break-words">
            {{$title->title}}
            <span class="text-sm">
              <i>@isset($title->getCategory) #{{$title->getCategory->name}} @else Bulunamadı @endisset</i>
            </span>
            <div class="float-right">
              <!-- ENTRY AYARLAR -->
              <x-jet-dropdown>
                  <x-slot name="trigger">
                      <button class="float-none sm:float-right p-0.5 m-0.5 rounded text-white"><i class="fas fa-ellipsis-h"></i></button>
                  </x-slot>

                  <x-slot name="content">
                      @if(Auth::check())
                      <div id="titleFollow" class="@isset($follow) hidden @else block @endisset cursor-pointer text-gray-600 mx-3 m-2 text-sm">
                        Takip Et
                      </div>
                      <div id="titleUnfollow" class="@isset($follow) block @else hidden @endisset cursor-pointer text-gray-600 mx-3 m-2 text-sm">
                        Takipten Çık
                      </div>
                    @endif
                      <div class="border-t border-gray-100"></div>

                      <div type="başlık" type_id="{{$title->id}}" class="plaintBtn cursor-pointer text-gray-600 mx-3 m-2 text-sm">
                        Şikayet Et
                      </div>

                  </x-slot>
              </x-jet-dropdown>
              <!-- ENTRY AYARLAR SON -->
            </div>
          </h1>
          <!-- BAŞLIK -->
          <div class="bg-white shadow-lg text-md break-words m-2 p-2 rounded">
            <p class="text-sm">
            {{$title->content}}
            </p>
            <div class="flex-initial mt-1">
              <small>
                <a @isset($title->getUser) href="{{route('myArticles',$title->getUser->name)}}" @else  @endisset class="hover:text-blue-800 text-blue-400">
                  @isset($title->getUser) {{$title->getUser->name}} @else Bulunamadı @endisset</a>
                  <span class="align-baseline">| <small>{{$title->created_at}}</small></span>
                  @if($title->upt != null)<small> | <i title="Düzenlendi" class="far fa-edit"></i></small> @endif
              </small>
            </div>
          </div>
          <!-- BAŞLIK SON -->

          <!-- ENTRY OLUŞTUR -->
          @if(Auth::check())
          <div class="m-2 p-2 bg-white rounded shadow-xl">
          <form method="post" action="{{route('createComment')}}">
            @csrf
            <input type="hidden" name="title_id" value="{{$title->id}}">
            <label class="block shadow-xl">
              <textarea name="comment" style="resize:none;" maxlength="3000" class="form-input mt-1 rounded block w-full" rows="6" placeholder="Yorumunuz"></textarea>
            </label>
            <label class="block mt-2 text-right">
              <input type="submit" value="Paylaş" class="bg-blue-400 w-4/12 p-2 rounded text-white shadow-xl">
            </label>
          </form>
        </div>
      @endif
      <!-- ENTRY OLUŞTUR SON -->

          <!-- ENTRYLER -->
          @foreach ($entry as $key => $value)
            <div x-data="{ show: false }" class="bg-white shadow-lg text-md break-words m-2 p-2 rounded">
              <p class="text-sm">
                {{$value->content}}
              </p>
              <div class="flex-initial mt-1">
                <small>
                  <a @isset($value->getUser) href="{{route('myArticles',$value->getUser->name)}}" @else @endisset class="hover:text-blue-800 text-blue-400">@isset($value->getUser) {{$value->getUser->name}} @else Bulunamadı @endisset</a>
                   | <button entry_id="{{$value->id}}" id="like{{$value->id}}" class="likeBtn @if(Auth::check()) @foreach (Auth::user()->getLike as $key => $values) @if($values->entry_id == $value->id) text-green-600 @endif @endforeach @endif rounded mx-1 p-0.5"><i title="Katılıyorum" class="far fa-thumbs-up"></i></button>
                   <button entry_id="{{$value->id}}" id="dis{{$value->id}}" class="disBtn @if(Auth::check()) @foreach (Auth::user()->getdisLike as $key => $values) @if($values->entry_id == $value->id) text-red-600 @endif @endforeach @endif rounded mx-1 p-0.5"><i title="Katılmıyorum" class="far fa-thumbs-down"></i></button>
                   <span class="align-baseline"> | <small>{{$value->created_at}}</small>@if($value->upt != null)<small> | <i title="Düzenlendi" class="far fa-edit"></i></small> @endif</span>
                 </small>
                 @if(Auth::check())
                   <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="float-none sm:float-right p-0.5 m-0.5 rounded text-blue-400"><i class="far fa-comment"></i> Yanıtla</button>
                 @endif
                <div class="float-none sm:float-right">
                  <!-- ENTRY AYARLAR -->
                  <x-jet-dropdown>
                      <x-slot name="trigger">
                          <button class="float-none sm:float-right p-0.5 m-0.5 rounded text-blue-400"><i class="fas fa-ellipsis-h"></i></button>
                      </x-slot>

                      <x-slot name="content">

                        <div type="entry" type_id="{{$value->id}}" class="plaintBtn cursor-pointer text-gray-600 mx-3 m-2 text-sm">
                          Şikayet Et
                        </div>

                      </x-slot>
                  </x-jet-dropdown>
                  <!-- ENTRY AYARLAR SON -->
                </div>
              </div>
              <div x-show.transition="show" class="mt-3 rounded">
                <form method="post" action="{{route('createReply')}}">
                  @csrf
                  <input type="hidden" name="entry_id" value="{{$value->id}}">
                  <input type="hidden" name="title_id" value="{{$title->id}}">
                  <label class="block shadow-xl">
                    <textarea name="comment" maxlength="3000" style="resize:none;" class="form-input mt-1 rounded block w-full" rows="6" placeholder="Yorumunuz"></textarea>
                  </label>
                  <label class="block my-2 text-right">
                    <input type="submit" value="Paylaş" class="bg-blue-400 w-4/12 p-2 rounded text-white shadow-xl">
                  </label>
                </form>
              </div>
            </div>
            <!-- CEVAPLAR -->
            @foreach ($value->getReply as $key => $values)
              <div class="bg-blue-400 ml-10 sm:ml-20 shadow-lg text-md text-white break-words m-2 p-2 rounded">
                <p class="text-sm">
                  {{$values->content}}
                </p>
                <div class="flex-initial mt-1">
                  <small><a @isset($values->getUser) href="{{route('myArticles',$value->getUser->name)}}" @else @endisset class="hover:text-blue-800 text-blue-600">@isset($values->getUser) {{$values->getUser->name}} @else Bulunamadı @endisset</a><span class="align-baseline"> |
                  <button entry_id="{{$values->id}}" id="replike{{$values->id}}" class="replikeBtn @if(Auth::check()) @foreach (Auth::user()->getReplyLike as $key => $valuess) @if($valuess->reply_id == $values->id) text-green-600 @endif @endforeach @endif rounded mx-1 p-0.5"><i title="Katılıyorum" class="far fa-thumbs-up"></i></button>
                  <button entry_id="{{$values->id}}" id="repdis{{$values->id}}" class="repdisBtn  @if(Auth::check()) @foreach (Auth::user()->getReplydisLike as $key => $valuess) @if($valuess->entry_id == $values->id) text-red-600 @endif @endforeach @endif rounded mx-1 p-0.5"><i title="Katılmıyorum" class="far fa-thumbs-down"></i></button>
                  <span class="align-baseline"> | <small>{{$values->created_at}}</small></span></small>
                  <div class="float-right">
                    <!-- ENTRY AYARLAR -->
                    <x-jet-dropdown>
                        <x-slot name="trigger">
                            <button class="float-none sm:float-right p-0.5 m-0.5 rounded text-white"><i class="fas fa-ellipsis-h"></i></button>
                        </x-slot>

                        <x-slot name="content">

                            <div type="yorum" type_id="{{$values->id}}" class="plaintBtn cursor-pointer text-gray-600 mx-3 m-2 text-sm">
                              Şikayet Et
                            </div>

                        </x-slot>
                    </x-jet-dropdown>
                    <!-- ENTRY AYARLAR SON -->
                  </div>
                </div>
              </div>
            @endforeach
            <!-- CEVAPLAR SON -->
          @endforeach
          {{$entry->links()}}
          <!-- ENTRYLER SON -->
        </div>
        <div class="hidden sm:block col-span-1">
          <!-- Kategoriler -->
            @include('layouts/navigation')
          <!-- Kategoriler SON-->
        </div>

      </div>

</div>

</x-app-layout>

<!-- FOOTER-->
@include('layouts/footer')
<!-- FOOTER SON-->

<script>
$(document).ready(function(){

  //TAKİP ET BUTONU
  $( "#titleFollow" ).click(function() {
    //VERİ POST KISMI
    titleId = {{$title->id}};
    userId = @if(Auth::check()) {{Auth::user()->id}};@else 0; @endif
    $.get("{{route('titleFollow')}}",{ titleId:titleId, userId:userId }, function(data, status){
      console.log(data);
    });

    //BUTTON GÖRÜNÜRLÜK KISMI
      //takip butonunu gizle
    $(this).removeClass("block");
    $(this).addClass("hidden");
      //takipten çıkar butonunu görünür yap
    $("#titleUnfollow").removeClass("hidden");
    $("#titleUnfollow").addClass("block");

  });

  //TAKİPTEN ÇIKAR BUTONU
  $( "#titleUnfollow" ).click(function() {
    //VERİ POST KISMI
    titleId = {{$title->id}};
    userId = @if(Auth::check()) {{Auth::user()->id}};@else 0; @endif
    $.get("{{route('titleUnfollow')}}",{ titleId:titleId, userId:userId }, function(data, status){
      console.log(data);
    });
    //BUTTON GÖRÜNÜRLÜK KISMI
      //takip butonunu gizle
    $(this).removeClass("block");
    $(this).addClass("hidden");
      //takipten çıkar butonunu görünür yap
    $("#titleFollow").removeClass("hidden");
    $("#titleFollow").addClass("block");
  });

  //ŞİKAYET
  kontrol=0;
  $( ".plaintBtn" ).click(function() {
    id = $(this)[0].getAttribute('type_id');
    type = $(this)[0].getAttribute('type');

    $.get("{{route('plaint')}}",{ id:id, type:type }, function(data, status){
      console.log(data);
    });

    $(this).html("Şikayetiniz alındı.");
  });

  //ENTRYLER LİKE
  $( ".likeBtn" ).click(function() {
    $(this).addClass("text-green-600");
    id = $(this).attr("entry_id");

    $.get("{{route('entryLike')}}",{ id:id }, function(data, status){
      console.log(data);
    });

    id = $(this).attr("entry_id");
    $("#dis"+id).removeClass("text-red-600");
    $(this).addClass("text-green-600");

  });

  // ENTRYLER DİSLİKE
  $( ".disBtn" ).click(function() {

    $(this).addClass("text-red-600");
    id = $(this).attr("entry_id");

    $.get("{{route('entrydisLike')}}",{ id:id }, function(data, status){
      console.log(data);
    });

    $("#like"+id).removeClass("text-green-600");
    $(this).addClass("text-red-600");

  });

  //YORUMLAR LİKE
  $( ".replikeBtn" ).click(function() {

    $(this).addClass("text-green-600");
    id = $(this).attr("entry_id");

    $.get("{{route('replyLike')}}",{ id:id }, function(data, status){
      console.log(data);
    });

    id = $(this).attr("entry_id");
    $("#repdis"+id).removeClass("text-red-600");
    $(this).addClass("text-green-600");

  });

  // YORUMLAR DİSLİKE
  $( ".repdisBtn" ).click(function() {

    $(this).addClass("text-red-600");
    id = $(this).attr("entry_id");

    $.get("{{route('replydisLike')}}",{ id:id }, function(data, status){
      console.log(data);
    });

    $("#replike"+id).removeClass("text-green-600");
    $(this).addClass("text-red-600");

  });

});
</script>
