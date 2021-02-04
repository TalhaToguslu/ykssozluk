
@isset($titleSearch)
  <h1>"{{$titleSearch}}" Arama Sonuçları</h1>
@endisset

<div class="bg-blue-400 text-white p-1 rounded flex justify-between items-center">
  <label><b>Başlıklar<b></label>
    <form method="get" action="{{route('adminTitleSearch')}}" class="hidden sm:block">
      <input class="text-black p-1 rounded" name="name" placeholder="Başlık Adı" type="text">
      <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
    </form>
</div>

<!-- MOBİL ARAMA KISMI -->
<form method="get" action="{{route('adminTitleSearch')}}" class="block sm:hidden m-1">
  <input class="text-black p-1 rounded w-10/12" name="name" placeholder="Başlık Adı" type="text">
  <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
</form>
<!-- MOBİL ARAMA KISMI SON -->

  <div class="rounded overflow-x-auto">
    <table class="border-collapse border-black table-auto w-full">
      <thead>
        <tr>
          <th class="bg-blue-400 text-white border-4">Başlık</th>
          <th class="bg-blue-400 text-white border-4">Kategori</th>
          <th class="bg-blue-400 text-white border-4">Sahibi</th>
          <th class="bg-blue-400 text-white border-4">Entry Sayısı</th>
          <th class="bg-blue-400 text-white border-4">Oluşturulma Tarihi</th>
          <th class="bg-blue-400 text-white border-4">Ayarlar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($titles as $key => $value)
          <tr>
            <td class="border-4 border-gray-200 bg-white p-1"><a href="{{route('show',$value->title)}}">{{$value->title}}</a></td>
            <td class="border-4 border-gray-200 bg-white p-1">@isset($value->getCategory){{$value->getCategory->name}} @else - @endisset</td>
            <td class="border-4 border-gray-200 bg-white p-1">@isset($value->getUser) {{$value->getUser->name}} @else - @endisset</td>
            <td class="border-4 border-gray-200 bg-white p-1"><a class="text-blue-600" href="{{route('adminEntry',$value->id)}}">{{count($value->getEntry)}}</a></td>
            <td class="border-4 border-gray-200 bg-white p-1">{{$value->created_at}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">
              <form method="get" action="{{route('adminTitleDelete')}}">
                <input type="hidden" name="titleId" value="{{$value->id}}">
                <button class="categoryDelete bg-red-500 text-white p-2 rounded w-full"><i class="fas fa-trash-alt"></i></button>
              </form>
              <div x-data="{ show: false }">
                <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="w-full bg-green-500 text-white rounded p-2"><i class="fas fa-pen"></i></button>
                <div x-show.transition="show" class="shadow my-2 bg-blue-100 rounded">
                  <form method="get" action="{{route('adminTitleUpdate')}}">
                    @csrf
                    <input type="hidden" name="title_id" value="{{$value->id}}">
                    <label class="block shadow-xl p-2 m-2 rounded">
                      <input name="title" maxlength="40" required class="form-input mt-1 rounded p-3 block w-full" value="{{$value->title}}" placeholder="Başlık">
                    </label>
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
    {{$titles->links()}}
  </div>
