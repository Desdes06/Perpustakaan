<div class="flex gap-4 items-center">
    <div class="flex justify-between items-center border-b-2 p-2 w-1/3">
        <input 
          type="text" 
          placeholder="Cari" 
          class="outline-none flex-grow px-2"
        >
        <button class="p-2 hover:bg-gray-100 rounded-full">
          <svg 
            xmlns="http://www.w3.org/2000/svg" 
            width="20" 
            height="20" 
            fill="#838383" 
            class="bi bi-search" 
            viewBox="0 0 16 16"
          >
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
          </svg>
        </button>
      </div>
    <div class="relative inline-block text-left" x-data="{ isOpen: false }">
        <div>
            <button  @click="isOpen = !isOpen"
                type="button" 
                class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-500" 
                id="menu-button" 
                aria-expanded="true" 
                aria-haspopup="true">
                Pilih
                <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <div x-show="isOpen"
            @click.away="isOpen = false"
            x-transition:enter="transition ease-out duration-100 transform"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75 transform"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none" 
            role="menu" 
            aria-orientation="vertical" 
            aria-labelledby="menu-button" 
            tabindex="-1">
        <div class="py-1" role="none">
            <h1 class="px-4 font-bold">KATEGORI</h1>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-0">Pendidik</a>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-1">Hiburan</a>
            <h1 class="px-4 font-bold">PENULIS</h1>
            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200" role="menuitem" tabindex="-1" id="menu-item-2">Penulis</a>
        </div>
        </div>
    </div> 
</div> 