@section('title',"yks sözlük | Hakkımızda")
<x-app-layout>

    <div class="contanier rounded mx-4 my-2 bg-white rounded shadow-xl p-3">
      <h1 class="text-blue-400 text-xl"><b>Hakkımızda</b></h1>
      <p class="break-words">
        {{$footer->Hakkimizda}}
      </p>
    </div>

    @isset($status)
      <div class="bg-green-400 p-1 text-white m-4 rounded">
        <b>{{$status}}</b>
      </div>
    @endisset

    <div class="contanier rounded mx-4 my-2 bg-white rounded shadow-xl p-3">

      <h1 class="text-blue-400 text-xl"><b>İletişim</b></h1>
      <form method="post" autocomplete="off" action="{{route('message')}}">
        @csrf
        <label class="block my-2">
          <input type="email" name="email" maxlength="40" required class="border border-gray-700 form-input mt-1 rounded p-3 block w-full" placeholder="Email">
        </label>
        <label class="block my-2">
          <input name="title" maxlength="30" required class="border border-gray-700 form-input mt-1 rounded p-3 block w-full" placeholder="Konu">
        </label>
        <label class="block my-2">
          <textarea style="resize:none;" required maxlength="3000" name="message" class="form-input mt-1 rounded p-3 block w-full" rows="6" placeholder="Mesajınız"></textarea>
        </label>
        <label class="block rounded text-right mt-2">
          <input type="submit" value="Gönder" class="bg-blue-400 w-4/12 p-2 rounded text-white shadow-xl">
        </label>
      </form>
    </div>

</x-app-layout>
