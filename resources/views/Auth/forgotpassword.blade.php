<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>lupa password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <div class="flex max-md:flex-col max-md:justify-center max-md:h-screen max-md:items-center max-sm:mx-2 max-md:mx-20">
        <div class="max-md:hidden bg-gradient-to-r from-purple-400 to-cyan-300 h-screen max-lg:w-1/2 w-3/5 relative text-white">
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
                    <h1 class="max-lg:text-5xl text-7xl font-bold">Lupa Password !</h1>
                    <img class="max-lg:p-10 max-lg:h-[50vh] p-12 mx-auto h-[70vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art2.png')}}" alt="">
                </div> 
            </div>
        </div>
        <img class="hidden max-md:block p-2 mx-auto h-[25vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art2.png')}}" alt="">
        <div class="max-lg:px-8 max-md:w-full max-lg:w-1/2 max-md:justify-center flex flex-col justify-center items-center w-2/5">
            @if(session()->has('status'))
                <div id="alert-border" class="max-sm:w-full w-3/5 flex items-center p-4 mb-4 text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM9 13a1 1 0 0 0 2 0V9a1 1 0 0 0-2 0v4Zm1-6.75a1.062 1.062 0 1 0 0 2.124 1.062 1.062 0 0 0 0-2.124Z"/>
                    </svg>
                    <span class="sr-only">Success</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('status') }}
                    </div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8" data-dismiss-target="#alert-border" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 13L13 1m0 12L1 1"/>
                        </svg>
                    </button>
                </div>
            @endif
            <x-form action="/Auth/forgotpassword" method="POST" title="Lupa Password" buttonText="Send">
                @csrf
                <div>
                    <label for="credential" class="max-sm:text-sm text-md p-4">Masukan Email</label><br>
                    <input type="text" name="email" id="email" class="max-sm:text-sm rounded-full p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none @error('email') is-invalid @enderror" placeholder="Email" autofocus required> 
                    @error('email')
                        <div class="invalid-feedback text-red-500 text-sm px-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>            
            </x-form>
        </div> 
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alertBox = document.getElementById('alert-border');
            const closeButton = alertBox?.querySelector('[data-dismiss-target]');

            if (alertBox && closeButton) {
                closeButton.addEventListener('click', function () {
                    alertBox.style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
