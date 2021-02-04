<x-app-layout>
    <x-slot name="header">
            {{ __('Gündem') }}
    </x-slot>

    <div class="contanier rounded">
      <div class="grid grid-rows-2 grid-flow-col">
        <!-- Saat Kısmı -->
        <div class="row-span-2 col-span-2 ... rounded">
          <div class="bg-red-500 rounded p-2 m-1 shadow-xl my-2">
            <p class="text-black text-6xl p-2">154<p class="text-black text-3xl p-2">Gün</p></p>
          </div>

          <div class="bg-green-400 shadow-xl rounded p-2 m-1 my-2">
            <p class="text-black text-6xl p-2">23<p class="text-black text-3xl p-2">Saat</p></p>
          </div>

          <div class="shadow-xl bg-blue-400 rounded p-2 m-1 my-2">
            <p class="text-black text-6xl p-2">54<p class="text-black text-3xl p-2">Dakika</p>
          </div>

          <div class="shadow-xl bg-gray-800 rounded p-2 m-1 my-2">
            <p class="text-white text-1xl p-2">Kaldı.</p>
          </div>
        </div>
        <!-- Saat Kısmı Son-->

        <!-- Günün Başlığı Kısmı -->
        <div class="col-span-1 row-span-1 bg-gray-800 shadow-xl rounded m-1 p-2 my-2">
          <h1 class="text-3xl m-2 text-white">Günün Başlığı</h1>
          <p class="text-white m-3 w-6/12 align-center">Loasdsadrem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir.</p>
          <button class="bg-purple-600 text-white p-2 rounded shadow-xl w-full  hover:bg-purple-900">İncele</button>
        </div>
        <!-- Günün Başlığı Kısmı Son -->

        <!-- Trendler Kısmı -->
        <div class="row-span-1 col-span-1 ...  bg-gray-700 m-1 p-2 rounded">
          <h1 class="text-3xl m-2 text-white">Trendler</h1>
          <ul>
            <a href="">
              <li class="bg-green-600 rounded m-3 p-2 shadow-xl hover:bg-gray-600">
                <p class="text-white">Başlık 1</p>
              </li>
            </a>
            <a href="">
              <li class="bg-green-600 rounded m-3 p-2 shadow-xl hover:bg-gray-700">
                <p class="text-white">Başlık 1</p>
              </li>
            </a>
            <a href="">
              <li class="bg-green-600 rounded m-3 p-2 shadow-xl hover:bg-gray-700">
                <p class="text-white">Başlık 1</p>
              </li>
            </a>
            <a href="">
              <li class="bg-green-600 rounded m-3 p-2 shadow-xl hover:bg-gray-700">
                <p class="text-white">Başlık 1</p>
              </li>
            </a>
            <a href="">
              <li class="bg-green-600 rounded m-3 p-2 shadow-xl hover:bg-gray-700">
                <p class="text-white">Başlık 1</p>
              </li>
            </a>
          </ul>
        </div>
        <!-- Trendler Kısmı Son -->

      </div>
    </div>


</x-app-layout>
