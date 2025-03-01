<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <div class="flex">
        <div class="bg-gradient-to-r from-blue-800 to-red-600 h-screen w-3/5 relative text-white">
            <div class="bg-black/15 h-screen p-9">
                <a href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="35" 
                        height="35" 
                        class="bi bi-arrow-left fill-current hover:fill-gray-300" 
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                </a>
                <div class="flex flex-col items-center justify-center h-full space-y-2 px-auto">
                    <h1 class="text-7xl font-bold">Masuk !</h1>
                    <img class="p-12 mx-auto h-[70vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art4.png')}}" alt="">
                </div> 
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
            <x-form action="/Auth/login" method="POST" title="Masuk" buttonText="Login">
                @csrf
                <div>
                    <label for="credential" class="text-md p-4">Masukan Email</label><br>
                    <input type="text" name="email" id="email" class="rounded-full p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none @error('email') is-invalid @enderror" placeholder="Email" autofocus required> 
                    @error('email')
                        <div class="invalid-feedback text-red-500 text-sm px-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password" class="text-md p-4">Password</label><br>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="rounded-full p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none" placeholder="Password" required>
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800 focus:outline-none">
                            <i class="fa fa-eye" id="showPasswordIcon"></i>
                            <i class="fa fa-eye-slash hidden" id="hidePasswordIcon"></i>
                        </button>
                    </div>
                </div>                
            </x-form>
            <p>Punya Akun?<a href="/Auth/registrasi" class="px-2 text-blue-500">Registrasi</a></p> 
        </div> 
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('alert-border');
            const togglePassword = document.getElementById('togglePassword');
            const password = document.getElementById('password');
            const showPasswordIcon = document.getElementById('showPasswordIcon');
            const hidePasswordIcon = document.getElementById('hidePasswordIcon');
            
            // Show/hide password toggle
            if (togglePassword) {
                togglePassword.addEventListener('click', function() {
                    if (password.type === 'password') {
                        password.type = 'text';
                        showPasswordIcon.classList.add('hidden');
                        hidePasswordIcon.classList.remove('hidden');
                    } else {
                        password.type = 'password';
                        showPasswordIcon.classList.remove('hidden');
                        hidePasswordIcon.classList.add('hidden');
                    }
                });
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('alert-border');
        });
    </script>
</body>
</html>
