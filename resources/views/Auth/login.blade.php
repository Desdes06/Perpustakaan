<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <div class="flex">
        <div class="text-white h-screen w-3/5 relative p-9"
             style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{ asset('img/book.jpg')}}'); background-size: cover; background-position: center; hover:fill-gray-300">
            <a href="/" class="">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    width="35" 
                    height="35" 
                    class="bi bi-arrow-left fill-current hover:fill-gray-300" 
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                </svg>
            </a>
            <div class="flex items-center justify-center h-full">
                <h1 class="text-7xl font-bold">Selamat Datang!</h1>
            </div> 
        </div>
        <div class="flex flex-col justify-center items-center w-2/5 space-y-2">
            @if(session()->has('loginError'))
                <div id="alert-border" class="w-3/5 flex items-center p-4 mb-4 text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9 13a1 1 0 0 0 2 0V9a1 1 0 0 0-2 0v4Zm1-6.75a1.062 1.062 0 1 0 0 2.124 1.062 1.062 0 0 0 0-2.124Z"/>
                    </svg>
                    <span class="sr-only">Error</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('loginError') }}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 13L13 1m0 12L1 1"/>
                        </svg>
                    </button>
                </div>
            @endif
            <x-form action="/Auth/login" method="POST" title="login" buttonText="Login">
                @csrf
                <div>
                    <label for="credential" class="text-md p-4">Masukan Email</label><br>
                    <input type="text" name="email" id="email" class="rounded-full border-black p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none @error('email') is-invalid @enderror" placeholder="Email" autofocus required> 
                    @error('email')
                        <div class="invalid-feedback text-red-500 text-sm px-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="text-md p-4">Password</label><br>
                    <input type="password" name="password" id="password" class="rounded-full border-black p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none" placeholder="Password" required>
                </div>                
            </x-form>
            <p>Punya Akun?<a href="/Auth/registrasi" class="px-2 text-blue-500">Registrasi</a></p> 
        </div> 
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('alert-border');
        });
    </script>
</body>
</html>
