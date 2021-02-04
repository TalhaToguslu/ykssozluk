<!-- Kategoriler -->
@foreach ($category as $key => $value)
  <a href="{{route('forumCategory',$value->name)}}">
    <div class="m-2 p-4 rounded shadow-xl text-white bg-blue-400">
      <label>#{{$value->name}}</label>
    </div>
  </a>
@endforeach
<!-- Kategoriler SON-->
