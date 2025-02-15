
<form class="max-w-2xl">
  <div class="flex">
      <button id="dropdown-button" data-dropdown-toggle="dropdown" class="shrink-0 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-md hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100" type="button">
          Filter
      <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
      </svg>
      </button>
    <div id="dropdown" class="z-10 hidden bg-white rounded-md shadow-md w-44 dark:bg-gray-700">
        @if($type === 'Admin/anggota')
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <li>
                    <a href="/{{ $type }}">
                        <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Semua Pengguna
                        </button>
                    </a>
                </li>
            </ul>
        @else
            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <h1 class="font-bold px-4">KATEGORI</h1>
                <li>
                    <a href="/{{ $type }}">
                        <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                            Semua Kategori
                        </button>
                    </a>
                </li>
                @foreach($kategori as $kategori)
                    <li>
                        <a href="/{{ $type }}/{{ $kategori->id }}">
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{ $kategori->nama_kategori }}
                            </button>
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="text-sm text-gray-700" aria-labelledby="dropdown-button">
                <h1 class="font-bold px-4">PENULIS</h1>
                @foreach($buku->pluck('penulis')->unique() as $penulis)
                    <li>
                        <a href="/{{ $type }}/{{ $penulis }}">
                            <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                {{ $penulis }}
                            </button>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>    
      <div class="relative w-screen">
        <form action="/{{ $type }}/search" method="GET">
          <div class="relative">
              <input 
                  type="search" 
                  name="search" 
                  id="search" 
                  class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-md border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500" 
                  placeholder="{{ $slot }}"
                  value="{{ request('search') }}"
              />
              <button type="submit" class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-black rounded-e-md hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                  </svg>
                  <span class="sr-only">Search</span>
              </button>
          </div>
        </form>
      </div>
  </div>
</form>