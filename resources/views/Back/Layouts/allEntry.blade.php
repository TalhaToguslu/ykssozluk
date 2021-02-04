<div class="bg-blue-400 text-white p-1 rounded flex justify-between items-center">
  <label><b>Tüm Entryler<b></label>
    <form method="get" action="{{route('adminAllEntrySearch')}}" class="hidden sm:block">
      <input class="text-black p-1 rounded" name="name" placeholder="Entry İçeriği" type="text">
      <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
    </form>
</div>

<form method="get" action="{{route('adminAllEntrySearch')}}" class="m-1 block sm:hidden">
  <input class="text-black p-1 w-10/12 rounded" name="name" placeholder="Entry İçeriği" type="text">
  <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
</form>

  <div class="rounded overflow-x-auto">
    <table class="border-collapse border-black table-fixed w-full break-words">
      <thead>
        <tr>
          <th class="bg-blue-400 text-white border-4">Başlık</th>
          <th class="bg-blue-400 text-white border-4">Entry</th>
          <th class="bg-blue-400 text-white border-4">Sahibi</th>
          <th class="bg-blue-400 text-white border-4">Oluşturulma Tarihi</th>
          <th class="bg-blue-400 text-white border-4">Ayarlar</th>
        </tr>
      </thead>

      <tbody>

        @foreach ($allEntry as $key => $value)
          <tr>
            <td class="border-4 border-gray-200 bg-white p-1">@isset($value->getTitle){{$value->getTitle->title}} @else Bulunamadı @endisset</td>
            <td class="border-4 border-gray-200 bg-white p-1">{{$value->content}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">@isset($value->getUser->name){{$value->getUser->name}} @else Bulunamadı @endisset</td>
            <td class="border-4 border-gray-200 bg-white p-1">{{$value->created_at}}</td>
            <td class="border-4 border-gray-200 bg-white p-1 w-300">
              <form method="get" action="{{route('adminAllEntryDelete')}}">
                <input type="hidden" name="entryId" value="{{$value->id}}">
                <button class="categoryDelete bg-red-500 text-white p-2 rounded w-full"><i class="fas fa-trash-alt"></i></button>
              </form>
              <div x-data="{ show: false }">
                <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="w-full bg-green-500 text-white rounded p-2"><i class="fas fa-pen"></i></button>
                <div x-show.transition="show" class="shadow my-2 bg-blue-100 rounded">
                  <form method="get" action="{{route('adminAllEntryUpdate')}}">
                    @csrf
                    <input type="hidden" name="entry_id" value="{{$value->id}}">
                    <label class="block shadow-xl p-2 m-2">
                      <textarea style="resize:none;" maxlength="3000" required name="article" class="form-input mt-1 rounded p-3 block w-full" rows="6" placeholder="Yorumunuz">{{$value->content}}</textarea>
                    </label>
                    <label class="block p-2">
                      <input type="submit" name="postBtn" value="Kaydet" class="bg-green-600  p-2 rounded text-white shadow-xl">
                    </label>
                  </form>
                </div>
              </div>
            </td>
          </tr>
        @endforeach

      </tbody>
    </table>

  </div>
