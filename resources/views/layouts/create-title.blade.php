<div x-data="{ show: false }" class="grid mx-2 mt-2 rounded bg-blue-400 p-1">
    <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }" class="break-words w-3/12 text-center text-sm p-2 rounded bg-white text-blue-400 hover:bg-blue-500 hover:text-white">Başlık Oluştur</button>
@if ($errors->any())
  <div class="bg-red-700 text-white rounded block p-2 m-2 shadow-xl">
      <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
@endif
<div x-show.transition="show" class="m-2 rounded">
    <form method="post" autocomplete="off" action="{{route('create')}}">
      @csrf
      <label class="block">
        <input name="title" maxlength="40" class="form-input mt-1 rounded p-3 block w-full" placeholder="Başlık">
      </label>
      <label class="block mt-2">
        <span class="text-white">Ne Hakkında?</span>
        <select name="category" class="form-select rounded block w-full mt-1">
          <option value="">...</option>
          @foreach ($category as $key => $value)
            <option value="{{$value->id}}">{{$value->name}}</option>
          @endforeach
        </select>
      </label>
      <label class="block">
        <textarea style="resize:none;" maxlength="3000" name="article" class="form-input mt-1 rounded p-3 block w-full" rows="6" placeholder="Yorumunuz"></textarea>
      </label>
      <label class="block rounded text-right mt-2">
        <input type="submit" value="Paylaş" class="bg-blue-300 w-4/12 p-2 rounded text-white shadow-xl">
      </label>
    </form>
</div>
</div>
