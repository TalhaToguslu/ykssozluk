@section('title',"yks sözlük | Öğrenci Topluluğu")
<x-app-layout>

    <div class="contanier rounded">

      <!--RESPONSİVE YKSSÖZLÜK ARAMA  -->
      <div class="block sm:hidden mx-2">
        @include('layouts/searchbar')
      </div>
      <!-- ARAMA SON -->

      <div class="grid grid-cols-5 m-2 p-2">
        <!-- GÜNDEM -->
        <div class="col-span-5 sm:col-span-4">
          @if(Auth::check())
            <!-- BAŞLIK OLUŞTUR -->
            @include('layouts/create-title')
            <!-- BAŞLIK OLUŞTUR SON-->
          @endif
          <h1 class="text-xl mx-2 mt-2 text-blue-400">
            @isset($search)
              "{{$search}}" Arama Sonuçları
            @else
              <a href="/" class="@isset($journal) font-bold @endisset">Gündem</a>
              |
              <a href="/new" class="@isset($new) font-bold @endisset">En Yeniler</a>
            @endisset
          </h1>
          @foreach ($titles as $key => $value)
              <a href="{{route('show',$value->slug)}}">
                <div class="bg-white shadow-lg text-md break-words m-2 p-2 rounded">
                  <h1 class="text-blue-400 my-1"><b>{{$value->title}}</b><span class="text-sm"><i> @isset($value->getCategory) #{{$value->getCategory->name}} @else #Bulunamadı @endisset</i></span><span class="float-right bg-blue-400 text-white rounded p-1">{{count($value->getEntry)}}</span></h1>
                  <p class="text-sm mr-2">
                    {{$value->content}}
                  </p>
                  <div class="flex-initial mt-1">
                    <small class=""><a @isset($value->getUser) href="{{route('myArticles',$value->getUser->name)}}" @endisset class="hover:text-blue-800 text-blue-400">@isset($value->getUser) {{$value->getUser->name}} @else Bulunamadı @endisset</a><span class="align-baseline">|
                    <small>{{$value->created_at}}</small></span></small>
                  </div>
                </div>
              </a>
          @endforeach

          <div class="m-2">
            {{$titles->links()}}
          </div>
        </div>
        <!-- GÜNDEM SON -->

        <!-- Kategoriler VE Enler -->
        <div class="hidden sm:block col-span-1">
          @include('layouts/navigation')
        </div>
        <!-- Kategoriler VE Enler SON -->

      </div>

      <!-- Kategoriler RESPONSİVE-->
      @include('layouts/category-responsive')
      <!-- Kategoriler RESPONSİVE SON-->
    </div>

</x-app-layout>

  <!-- FOOTER-->
  @include('layouts/footer')
  <!-- FOOTER SON-->
