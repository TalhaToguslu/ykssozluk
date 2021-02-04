
<div class="grid grid-cols-2">
  <div class="rounded m-1 bg-blue-400">
    <form method="get" action="{{route('adminFooterUpdate')}}">
      <label class="block mx-1 p-1 rounded text-white">
        Instagram
        <input name="insta" class="text-black form-input p-1 w-full rounded block" value="{{$footer->instagram}}" placeholder="Url">
      </label>
      <label class="block mx-1 p-1 rounded text-white">
        <input class="bg-green-600 rounded p-1" type="submit" value="Kaydet">
      </label>
    </form>
  </div>
  <div class="rounded m-1 bg-blue-400">
    <form method="get" action="{{route('adminFooterUpdate')}}">
      <label class="block mx-1 p-1 rounded text-white">
        Github
        <input name="git" class="text-black form-input p-1 w-full rounded block" value="{{$footer->github}}" placeholder="Url">
      </label>
      <label class="block mx-1 p-1 rounded text-white">
        <input class="bg-green-600 rounded p-1" type="submit" value="Kaydet">
      </label>
    </form>
  </div>
  <div class="rounded m-1 bg-blue-400">
    <form method="get" action="{{route('adminFooterUpdate')}}">
      <label class="block mx-1 p-1 rounded text-white">
        Linkedln
        <input name="link" class="text-black form-input p-1 w-full rounded block" value="{{$footer->linkedln}}" placeholder="Url">
      </label>
      <label class="block mx-1 p-1 rounded text-white">
        <input class="bg-green-600 rounded p-1" type="submit" value="Kaydet">
      </label>
    </form>
  </div>
</div>

<div class="border-t-2 m-1 border-blue-400"></div>

<div class="rounded my-2 m-1 bg-blue-400">
  <form method="get" action="{{route('adminFooterUpdate')}}">
    <label class="block mx-1 p-1 rounded text-white">
      Hakkımızda
      <textarea style="resize:none;" maxlength="2000" required name="hak" class="form-input mt-1 text-black rounded p-3 block w-full" rows="6" placeholder="Hakkımızda">{{$footer->Hakkimizda}}</textarea>
    </label>
    <label class="block mx-1 p-1 rounded text-white">
      <input class="bg-green-600 rounded p-1" type="submit" value="Kaydet">
    </label>
  </form>
</div>

<div class="border-t-2 m-1 border-blue-400"></div>

<div class="grid grid-cols-2">
  <div class="rounded m-1">
    <p class="bg-blue-400 p-1 rounded-t-md text-white"><b>Toplam Kullancı Sayısı</b></p>
    <p class="bg-white rounded-b-md p-1">{{$countUser}}</p>
  </div>
  <div class="rounded m-1">
    <p class="bg-blue-400 p-1 rounded-t-md text-white"><b>Toplam Başlık Sayısı</b></p>
    <p class="bg-white rounded-b-md p-1">{{$countTitle}}</p>
  </div>
  <div class="rounded m-1">
    <p class="bg-blue-400 p-1 rounded-t-md text-white"><b>Toplam Entry Sayısı</b></p>
    <p class="bg-white rounded-b-md p-1">{{$countEntry}}</p>
  </div>
  <div class="rounded m-1">
    <p class="bg-blue-400 p-1 rounded-t-md text-white"><b>Toplam Yorum Sayısı</b></p>
    <p class="bg-white rounded-b-md p-1">{{$countReply}}</p>
  </div>
</div>
