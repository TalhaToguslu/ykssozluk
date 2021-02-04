@isset($categorySearch)
  <h1>"{{$categorySearch}}" Arama Sonuçları</h1>
@endisset

<div class="bg-blue-400 text-white p-1 rounded flex justify-between items-center">
  <div x-data="{ show: false }">
    <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="bg-green-600 p-2 rounded"><i class="fas fa-plus"></i></button>
    <div x-show.transition="show" class="shadow my-2 bg-blue-100 rounded">
      <form method="get" action="{{route('adminCategoryCreate')}}">
        @csrf
        <input type="hidden" name="cat_id" value="">
        <label class="block shadow-xl p-2 m-2 rounded">
          <input name="name" maxlength="20" required class="text-black form-input mt-1 rounded p-3 block w-full" value="" placeholder="Kategori Adı">
        </label>
        <label class="block p-2">
          <input type="submit" name="postBtn" value="Kaydet" class="bg-green-600 p-2 rounded text-white shadow-xl">
        </label>
      </form>
    </div>
  </div>
  <label><b>Kategoriler<b></label>
    <!-- ARAMA KISMI -->
  <form method="get" action="{{route('adminCategorySearch')}}" class="hidden sm:block">
    <input class="text-black p-1 rounded" name="name" placeholder="Kategori Adı" type="text">
    <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
  </form>
    <!-- ARAMA KISMI SON -->
</div>

<!-- MOBİL ARAMA KISMI -->
<form method="get" action="{{route('adminCategorySearch')}}" class="block sm:hidden m-1">
  <input class="text-black p-1 rounded w-10/12" name="name" placeholder="Kategori Adı" type="text">
  <input class="p-1 bg-white text-blue-400 rounded" type="submit" value="Ara">
</form>
<!-- MOBİL ARAMA KISMI SON -->

  <div class="rounded overflow-x-auto">
    <table class="border-collapse border-black table-auto w-full">
      <thead>
        <tr>
          <th class="bg-blue-400 text-white border-4">Adı</th>
          <th class="bg-blue-400 text-white border-4">Başlık Sayısı</th>
          <th class="bg-blue-400 text-white border-4">Ayarlar</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($category as $key => $value)
          <tr>
            <td class="border-4 border-gray-200 bg-white p-1">{{$value->name}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">{{count($value->getTitle)}}</td>
            <td class="border-4 border-gray-200 bg-white p-1">
              <form method="get" action="{{route('adminCategoryDelete')}}">
                <input type="hidden" name="catId" value="{{$value->id}}">
                <button class="categoryDelete bg-red-500 text-white p-2 rounded w-full"><i class="fas fa-trash-alt"></i></button>
              </form>
              <div x-data="{ show: false }">
                <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="w-full bg-green-500 text-white rounded p-2"><i class="fas fa-pen"></i></button>
                <div x-show.transition="show" class="shadow my-2 bg-blue-100 rounded">
                  <form method="get" action="{{route('adminCategoryUpdate')}}">
                    @csrf
                    <input type="hidden" name="cat_id" value="{{$value->id}}">
                    <label class="block shadow-xl p-2 m-2 rounded">
                      <input name="name" maxlength="40" required class="form-input mt-1 rounded p-3 block w-full" value="{{$value->name}}" placeholder="Başlık">
                    </label>
                    <label class="block p-2">
                      <input type="submit" name="postBtn" value="Kaydet" class="bg-green-600 w-3/12 p-2 rounded text-white shadow-xl">
                    </label>
                  </form>
                </div>
              </div>
            </td>
            </div>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
  $(document).ready(function(){


  });
  </script>
