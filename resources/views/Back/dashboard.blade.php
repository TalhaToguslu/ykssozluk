@section('googlebot','googlebot')
@section('noindex','noindex')
<x-app-layout>
  <div class="contanier grid grid-cols-6 m-2">

    <!-- NAVİGATİON -->
    <div class="hidden sm:block bg-blue-400 p-1 rounded">
      @include('Back/Layouts/navigation')
    </div>
    <!-- NAVİGATİON SON -->

    <div class="col-span-6 sm:col-span-5 p-1 ml-1">

      <!-- TOPLAM KULLANICI,BAŞLIK VS. -->
      @isset($countUser)
        @include('Back/Layouts/count')
      @endisset
      <!-- TOPLAM KULLANICI,BAŞLIK VS. SON -->

      <!-- KULLANICILAR -->
      @isset($users)
        @include('Back/Layouts/users')
      @endisset
      <!-- KULLANICILAR SON -->

      <!-- BAŞLIKLAR -->
      @isset($titles)
        @include('Back/Layouts/titles')
      @endisset
      <!-- BAŞLIKLAR SON -->

      <!-- ŞİKAYETLER -->
      @isset($plaints)
        @include('Back/Layouts/plaints')
      @endisset
      <!-- ŞİKAYETLER SON -->

      <!-- KATEGORİLER -->
      @isset($category)
        @include('Back/Layouts/category')
      @endisset
      <!-- KATEGORİLER SON -->

      <!-- ENTRYLER -->
      @isset($entry)
        @include('Back/Layouts/entry')
      @endisset
      <!-- ENTRYLER SON -->

      <!-- MAİL -->
      @isset($message)
        @include('Back/Layouts/mail')
      @endisset
      <!-- MAİL SON -->

      <!-- TÜM ENTRTLER -->
      @isset($allEntry)
        @include('Back/Layouts/allEntry')
      @endisset
      <!-- TÜM ENTRYLER SON -->

    </div>
  </div>

  <!-- MOBİL NAVİGATİON -->
  <div class="block sm:hidden bg-blue-400 p-1 rounded m-1">
    @include('Back/Layouts/navigation')
  </div>
  <!-- MOBİL NAVİGATİON SON-->

</x-app-layout>
