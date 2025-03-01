@vite('resources/css/font.css')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<form action="{{ $action }}" method="POST" 
    class="bg-[#413C88]/20 shadow-md w-3/5 p-8 rounded-xl flex flex-col space-y-4">
    @csrf
    <h1 class="text-3xl font-bold mx-auto">{{ $title }}</h1>

    {{ $slot }}

    <button class="bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br rounded-full p-2 text-white w-28 mx-auto" type="submit">
        {{ $buttonText }}
    </button>
</form>