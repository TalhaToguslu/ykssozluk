<h1 class="bg-blue-400 text-white p-1 rounded"><b>Şikayetler<b></h1>
  <div class="rounded overflow-x-auto">
    <table class="border-collapse border-black table-auto w-full">
      <thead>
        <tr>
          <th class="bg-blue-400 text-white border-4">Şikayet Edilen</th>
          <th class="bg-blue-400 text-white border-4">Şikayet Edilen İçerik</th>
          <th class="bg-blue-400 text-white border-4">Şikayet Sayısı</th>
          <th class="bg-blue-400 text-white border-4">Ayarlar</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($plaints as $key => $value)
            <tr>
              <td class="border-4 border-gray-200 bg-white p-1">{{$value->type}}</td>
              <td class="border-4 border-gray-200 bg-white p-1">
                @if($value->type=="başlık")
                  <a @isset($value->getTitle) href="{{route('show',$value->getTitle->title)}}" @else href="" @endisset>
                    @isset($value->getTitle)
                      {{$value->getTitle->title}}
                    @else
                      Bulunamadı
                    @endisset
                  </a>
                @elseif($value->type=="entry")
                  <a @isset($value->getTitle) href="{{route('show',$value->getTitle->title)}}" @else href="" @endisset>
                      @isset($value->getEntry)
                        {{$value->getEntry->content}}
                      @endisset
                  </a>
                @else
                  @isset($value->getReply)
                    {{$value->getReply->content}}
                  @endisset
                @endif
                </td>
              <td class="border-4 border-gray-200 bg-white p-1">{{$value->count}}</td>
              <td class="border-4 border-gray-200 bg-white p-1">
                <form method="get" action="{{route('adminComplainDelete')}}">
                  <input type="hidden" name="plaintId" value="{{$value->id}}">
                  <button class="bg-red-600 text-white p-1 rounded m-1"><i class="fas fa-trash-alt"></i>Şikayet Edileni Sil</button>
                </form>
                <form method="get" action="{{route('adminPlaintsDelete')}}">
                  <input type="hidden" name="plaintId" value="{{$value->id}}">
                  <button class="bg-blue-600 text-white p-1 rounded m-1"><i class="fas fa-trash-alt"></i>Şikayeti Sil</button>
                </form>
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>
    {{$plaints->links()}}
  </div>
