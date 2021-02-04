<h1 class="bg-blue-400 text-white p-1 rounded"><b>Mailler<b></h1>
  <div class="rounded overflow-x-auto">
    <table class="border-collapse border-black table-auto w-full">
      <thead>
          <tr>
            <th class="bg-blue-400 text-white border-4">Email</th>
            <th class="bg-blue-400 text-white border-4">Konu</th>
            <th class="bg-blue-400 text-white border-4">Mesaj</th>
            <th class="bg-blue-400 text-white border-4">Ayarlar</th>
          </tr>

      </thead>
      <tbody>
          @foreach ($message as $key => $value)
            <tr>
              <td class="border-4 border-gray-200 bg-white p-1">{{$value->email}}</td>
              <td class="border-4 border-gray-200 bg-white p-1">{{$value->konu}}</td>
              <td class="border-4 border-gray-200 bg-white p-1">{{$value->message}}</td>
              <td class="border-4 border-gray-200 bg-white p-1">
                <form method="get" action="">
                  <input type="hidden" name="messageId" value="{{$value->id}}">
                  <button class="bg-blue-400 p-1 m-0.5 text-white rounded">Cevapla</button>
                </form>
                <form method="get" action="{{route('adminMailDelete')}}">
                  <input type="hidden" name="messageId" value="{{$value->id}}">
                  <button class="bg-red-600 p-1 m-0.5 text-white rounded">Sil</button>
                </form>
              </td>
            </tr>
          @endforeach
      </tbody>
    </table>

  </div>
