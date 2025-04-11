<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<nav class="bg-gradient-to-r from-purple-600 to-red-300" x-data="{ isMenuOpen: false, isProfileOpen: false, isSettingOpen: false }">
  <div class="max-w-full p-2 sm:px-6 lg:px-8 mx-5">
    <div class="relative flex max-sm:h-14 h-20 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button -->
        <button type="button" @click="isMenuOpen = !isMenuOpen"
          class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 sm:hover:bg-gray-700 hover:text-white"
          aria-controls="mobile-menu"
          :aria-expanded="isMenuOpen"
        >
          <span class="sr-only">Open main menu</span>
          <svg
            :class="{ hidden: isMenuOpen, block: !isMenuOpen }"
            class="block h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="black"
            aria-hidden="true"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <svg
            :class="{ block: isMenuOpen, hidden: !isMenuOpen }"
            class="hidden h-6 w-6"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="black"
            aria-hidden="true"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex items-center justify-between">
        <div class="flex shrink-0 items-center hidden sm:block">
          <img class="h-8 w-auto" src="{{ asset('img/logo.png') }}" alt="Your Company" />
        </div>
        <div class="absolute inset-x-0 flex justify-center">
          <div class="flex space-x-4 hidden sm:ml-6 sm:block">
            @php $currentRoute = request()->path(); @endphp
              <a href="/User/beranda" 
                 class="relative text-md font-medium transition-colors duration-300 {{ $currentRoute == 'User/beranda' ? 'text-black' : 'text-gray-700 hover:text-black' }}">
                  Beranda
                  <span class="absolute bottom-[-4px] left-1/2 h-[2px] bg-black rounded-full transition-all duration-300 ease-in-out transform -translate-x-1/2
                        {{ $currentRoute == 'User/beranda' ? 'w-full' : 'w-2 opacity-50' }}">
                  </span>
              </a>
          
              <a href="/User/buku" 
                 class="relative text-md font-medium transition-colors duration-300 {{ $currentRoute == 'User/buku' ? 'text-black' : 'text-gray-700 hover:text-black' }}">
                  Daftar Buku
                  <span class="absolute bottom-[-4px] left-1/2 h-[2px] bg-black rounded-full transition-all duration-300 ease-in-out transform -translate-x-1/2
                        {{ $currentRoute == 'User/buku' ? 'w-full' : 'w-2 opacity-50' }}">
                  </span>
              </a>
          
              <a href="/User/pinjam" 
                 class="relative text-md font-medium transition-colors duration-300 {{ $currentRoute == 'User/pinjam' ? 'text-black' : 'text-gray-700 hover:text-black' }}">
                  Daftar Pinjam
                  <span class="absolute bottom-[-4px] left-1/2 h-[2px] bg-black rounded-full transition-all duration-300 ease-in-out transform -translate-x-1/2
                        {{ $currentRoute == 'User/pinjam' ? 'w-full' : 'w-2 opacity-50' }}">
                  </span>
              </a>          
          </div>
        </div>
      </div>

      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        {{-- <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
          </svg>
        </button> --}}

        <div class="sm:hidden">
          <a href="/Auth/profile">
            <button type="button"
              class="relative flex rounded-full bg-gray-800 text-sm"
            >
            @if ($user->foto)
              <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="h-10 w-auto rounded-full">
            @else
              <img src="{{ asset('img/profile.png') }}" alt="Default Foto" class="bg-gray-200 p-1 h-10 w-auto rounded-full">
            @endif
            </button>
          </a>
        </div>
  
        <!-- Profile dropdown -->
        <div class="relative ml-3 max-sm:hidden">
          <div>
            <button type="button" @click="isProfileOpen = !isProfileOpen"
              class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-purple-600"
              id="user-menu-button"
              :aria-expanded="isProfileOpen"
              aria-haspopup="true"
            >
            @if ($user->foto)
              <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="h-10 w-auto rounded-full">
            @else
              <img src="{{ asset('img/profile.png') }}" alt="Default Foto" class="bg-gray-200 p-1 h-10 w-auto rounded-full">
            @endif
            </button>
          </div>

          <div x-show="isProfileOpen"
            @click.away="isProfileOpen = false"
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 z-10 mt-2 max-sm:w-56 w-96 origin-top-right rounded-md bg-white pb-2 shadow-lg ring-1 ring-black/5 focus:outline-none"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="user-menu-button"
            tabindex="-1">
            <div class="flex items-center p-2">
                <div class="bg-gradient-to-r from-purple-600 to-red-300 w-full rounded-md p-4 flex max-sm:flex-col items-center space-x-4">
                  @if ($user->foto)
                    <img src="{{ asset('storage/' . $user->foto) }}" alt="Foto Profil" class="max-sm:h-14 h-20 w-auto rounded-full">
                  @else
                    <img src="{{ asset('img/profile.png') }}" alt="Default Foto" class="bg-gray-200 p-2 max-sm:h-14 h-20 w-auto rounded-full">
                  @endif
                    <div class="p-2 w-full">
                      <div class="flex justify-between items-center">
                        <p class="max-sm:text-sm text-md text-gray-700 text-white font-semibold">{{ Str::limit($user->username,'13') }}</p>
                        <button @click="isSettingOpen = !isSettingOpen">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-gear-fill" viewBox="0 0 16 16">
                              <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                          </svg>
                        </button>
                
                        <div x-show="isSettingOpen"
                        @click.away="isSettingOpen = false"
                        x-transition:enter="transition ease-out duration-100 transform"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75 transform"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-4 z-10 mt-28 w-auto origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
                        role="menu"
                        aria-orientation="vertical"
                        aria-labelledby="user-menu-button"
                        tabindex="-1">
                          <div class="p-2 space-y-2">
                              <div class="text-center">
                                <a href="/User/riwayat">
                                  <button class="flex space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="black" class="bi bi-clock-history" viewBox="0 0 16 16">
                                      <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z"/>
                                      <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                                      <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                                    </svg>
                                    <p class="text-sm text-gray-700">Riwayat</p>
                                  </button>
                                </a>
                              </div>
                              <div class="text-center">
                                <a href="/User/pesan">
                                  <button class="flex space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                      <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                    </svg>
                                    <p class="text-sm text-gray-700">Hubungi Admin</p>
                                  </button>
                                </a>
                              </div>
                          </div>
                        </div>
                      </div>
                        <p class="max-sm:hidden text-sm text-gray-700 text-white pb-2">{{ Str::limit($user->email,'24') }}</p>
                        <a href="/Auth/profile">
                            <button class="text-sm text-gray-700 bg-gray-300 p-2 hover:bg-gray-400 hover:text-white rounded-xl">Lihat Profile</button>
                        </a>
                    </div>
                </div>
            </div>
            <a href="/Auth/logout" class="block px-4 py-2 text-sm text-gray-700 flex items-center space-x-2 hover:text-red-500" role="menuitem" tabindex="-1" id="user-menu-item-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                    <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                </svg>
                <p>Keluar</p>
            </a>
        </div>

        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="sm:hidden" id="mobile-menu">
    <div x-show="isMenuOpen"
    @click.away="isMenuOpen = false" 
    class="space-y-1 px-2 pb-3 pt-2">
      <a href="/User/beranda" class="max-sm:text-sm block px-3 py-2 text-base font-medium text-black hover:text-gray-600" aria-current="page">Beranda</a>
      <a href="/User/buku" class="max-sm:text-sm block px-3 py-2 text-base font-medium text-black hover:text-gray-600">Daftar Buku</a>
      <a href="/User/pinjam" class="max-sm:text-sm block px-3 py-2 text-base font-medium text-black hover:text-gray-600">Daftar Pinjam</a>
    </div>
  </div>
</nav>
