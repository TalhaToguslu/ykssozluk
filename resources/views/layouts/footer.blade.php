<footer class="bg-blue-400 p-5 flex justify-between m-1 rounded text-white">
  <div class="p-1">
    <a href="{{route('infoShow')}}" class="hover:text-blue-600">
      <small>Hakkımızda |</small>
      <small>İletişim</small>
    </a>
  </div>
  <div class="p-1">

  </div>
  <div class="p-1 text-xl">
    <a href="{{$footer->linkedln}}" target="_blank" class="hover:text-blue-600">
      <i class="fab fa-linkedin"></i>
    </a>
    | <a href="{{$footer->github}}" target="_blank" class="hover:text-blue-600">
        <i class="fab fa-github"></i>
      </a>
    | <a href="{{$footer->instagram}}" target="_blank" class="hover:text-blue-600">
        <i class="fab fa-instagram"></i>
      </a>
  </div>
</footer>
