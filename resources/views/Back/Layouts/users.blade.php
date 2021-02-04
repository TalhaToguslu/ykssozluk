
  @isset($userSearch)
    <h1>"{{$userSearch}}" Arama Sonuçları</h1>
  @endisset

  <div class="bg-blue-400 text-white p-1 rounded flex justify-between items-center">
    <label><b>Kullanıcılar<b></label>
      <form method="get" action="{{route('adminUsersSearch')}}" class="hidden sm:block">
        <input class="text-black p-1 rounded" name="name" placeholder="Kullanıcı Adı" type="text">
        <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
      </form>
  </div>

  <!-- MOBİL ARAMA KISMI -->
  <form method="get" action="{{route('adminUsersSearch')}}" class="block sm:hidden m-1">
    <input class="text-black p-1 rounded w-10/12" name="name" placeholder="Kullanıcı Adı" type="text">
    <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
  </form>
  <!-- MOBİL ARAMA KISMI SON -->

  <div class="rounded overflow-x-auto">
    <table class="border-collapse border-black table-auto w-full">
      <thead>
        <tr>
          <th class="bg-blue-400 text-white border-4">Kullancı Adı</th>
          <th class="bg-blue-400 text-white border-4">Email</th>
          <th class="bg-blue-400 text-white border-4">Başlık</th>
          <th class="bg-blue-400 text-white border-4">Entry</th>
          <th class="bg-blue-400 text-white border-4">Üyelik Tarihi</th>
          <th class="bg-blue-400 text-white border-4">Ayarlar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($users as $key => $value)
          <tr>
            <td class="border-4 border-gray-200 bg-white p-1">{{$value->name}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">{{$value->email}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">{{count($value->getTitle)}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">{{count($value->getEntry)}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">{{$value->created_at}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">
              <div class="flex">
                <button userId="{{$value->id}}" id="yntc{{$value->id}}" class="btnYonetici @if($value->admin==1) hidden @else block @endif bg-blue-600 text-white mx-0.5 p-1 rounded hover:bg-blue-400">Yönetici Yap</button>
                <button userId="{{$value->id}}" id="yntcDown{{$value->id}}" @if($value->id == 1) disabled @endif  class="btnDownYonetici @if($value->admin==1) block @else hidden @endif bg-blue-600 text-white mx-0.5 p-1 rounded hover:bg-blue-400">Yöneticilikten Çıkar</button>
                <button userId="{{$value->id}}" class="btnSil bg-red-600 text-white mx-0.5 p-1 rounded hover:bg-red-400">Sil</button>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{$users->links()}}
  </div>

  <script>
  $(document).ready(function(){

    //YÖNETİCİ YAP BUTONU
    $( ".btnYonetici" ).click(function() {
      userId = $(this)[0].getAttribute('userId');
      change = 1;

      $.get("{{route('adminUserType')}}",{ userId:userId, change:change }, function(data, status){
        console.log(data);
      });

      //BUTTON GÖRÜNÜRLÜK KISMI
        //Yönetici yap butonunu gizle
      $(this).removeClass("block");
      $(this).addClass("hidden");
        //yöneticilikten çıkar butonunu görünür yap
      $("#yntcDown"+userId).removeClass("hidden");
      $("#yntcDown"+userId).addClass("block");

    });

    //YÖNETİCİLİKTEN ÇIKAR BUTONU
    $( ".btnDownYonetici" ).click(function() {
      userId = $(this)[0].getAttribute('userId');
      change = 0;

      $.get("{{route('adminUserType')}}",{ userId:userId, change:change }, function(data, status){
        console.log(data);
      });

      //BUTTON GÖRÜNÜRLÜK KISMI
        //Yönetici yap butonunu gizle
      $(this).removeClass("block");
      $(this).addClass("hidden");
        //yöneticilikten çıkar butonunu görünür yap
      $("#yntc"+userId).removeClass("hidden");
      $("#yntc"+userId).addClass("block");

    });

    $( ".btnSil" ).click(function() {
      userId = $(this)[0].getAttribute('userId');

      $.get("{{route('adminUserDelete')}}",{ userId:userId }, function(data, status){
        console.log(data);
      });
      location.reload();// SAYFAYI YENİDEN YÜKLE
    });



  });
  </script>
