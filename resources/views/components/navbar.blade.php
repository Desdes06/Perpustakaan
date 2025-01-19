<nav class="bg-black" x-data="{ isMenuOpen: false, isProfileOpen: false }">
  <div class="max-w-full px-2 sm:px-6 lg:px-8">
    <div class="relative flex h-20 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button -->
        <button type="button" @click="isMenuOpen = !isMenuOpen"
          class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
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
            stroke="currentColor"
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
            stroke="currentColor"
            aria-hidden="true"
          >
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex items-center justify-between">
        <div class="flex shrink-0 items-center hidden sm:block">
          <img class="h-8 w-auto" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
        </div>
        <div class="absolute inset-x-0 flex justify-center">
          <div class="flex space-x-4 hidden sm:ml-6 sm:block">
            <a href="/dashboard" class="text-sm font-medium text-white hover:text-gray-300" aria-current="page">Dashboard</a>
            <a href="/pinjam" class="text-sm font-medium text-white hover:text-gray-300">Pinjam</a>
          </div>
        </div>
      </div>

      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
          <span class="sr-only">View notifications</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
          </svg>
        </button>

        <!-- Profile dropdown -->
        <div class="relative ml-3">
          <div>
            <button type="button" @click="isProfileOpen = !isProfileOpen"
              class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
              id="user-menu-button"
              :aria-expanded="isProfileOpen"
              aria-haspopup="true"
            >
              <img class="h-8 w-8 rounded-full" alt="" />
            </button>
          </div>

          <div x-show="isProfileOpen"
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 z-10 mt-2 w-96 origin-top-right rounded-md bg-white pb-2 shadow-lg ring-1 ring-black/5 focus:outline-none"
            role="menu"
            aria-orientation="vertical"
            aria-labelledby="user-menu-button"
            tabindex="-1">
            <div class="flex items-center p-2">
              <div class="bg-slate-800 w-full rounded-md p-2 flex items-center">
                <img class="h-8 w-auto px-4" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
                  <div class="p-2">
                    <p class="text-md text-gray-700 text-white font-semibold">desvi</p>
                    <p class="text-sm text-gray-700 text-white pb-2">desssshhhhhhhhh@gmail</p>
                    <a href="/profile">
                      <button class="text-sm text-gray-700 bg-gray-300 p-2 hover:bg-gray-400 hover:text-white rounded-xl">Lihat Profile</button> 
                    </a>
                  </div>
              </div>
            </div>
            <a href="/logout" class="block px-4 py-2 text-sm text-gray-700 flex items-center space-x-2 hover:text-red-500" role="menuitem" tabindex="-1" id="user-menu-item-2">
              <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
              </svg>
              <p>Keluar</p></a>  
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div class="sm:hidden" id="mobile-menu">
    <div x-show="isMenuOpen" class="space-y-1 px-2 pb-3 pt-2">
      <a href="/dashboard" class="block px-3 py-2 text-base font-medium text-white hover:bg-gray-700" aria-current="page">Dashboard</a>
      <a href="/pinjam" class="block px-3 py-2 text-base font-medium text-white hover:bg-gray-700">Pinjam</a>
    </div>
  </div>
</nav>
