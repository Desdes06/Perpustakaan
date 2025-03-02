<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
</head>
<body>
    <div class="flex">
        <div class="bg-gradient-to-r from-blue-800 to-red-600 text-white h-screen w-3/5 relative">
            <div class="bg-black/15 h-screen p-9">
                <a href="/Auth/login" class="">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        width="35" 
                        height="35" 
                        class="bi bi-arrow-left fill-current hover:fill-gray-300" 
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                </a>
                <div class="flex flex-col items-center justify-center h-full space-y-2 px-auto">
                    <h1 class="text-7xl font-bold text-center">Registrasi!</h1>
                    <img class="p-12 mx-auto h-[70vh] w-auto hover:scale-105 transition-transform duration-300" src="{{ asset('img/d_art3.png')}}" alt="">
                </div> 
            </div>
        </div>
        <div class="flex justify-center items-center w-2/5">
            <x-form action="/Auth/registrasi" method="POST" title="Registrasi" buttonText="Registrasi">
                @csrf
                <div>
                    <label for="email" class="text-md p-4">Masukkan Email</label><br>
                    <input type="email" name="email" id="email" class="rounded-full p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none" placeholder="Email" autofocus required 
                    @error('email') is-invalid @enderror> 
                    @error('email')
                        <div class="invalid-feedback text-red-500 text-sm px-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="username" class="text-md p-4">Masukkan Username</label><br>
                    <input type="text" name="username" id="username" class="rounded-full p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none" placeholder="Username" required>
                </div>
                <div>
                    <label for="password" class="text-md p-4">Password</label><br>
                    <div class="relative">
                        <input type="password" name="password" id="password" class="rounded-full p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none" minlength="8" placeholder="Password" required>
                        <button type="button" id="togglePassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800 focus:outline-none">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback text-red-500 text-sm px-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="text-md p-4">Ulangi Password</label><br>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="rounded-full p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none" minlength="8" placeholder="Ulangi Password" required>
                        <button type="button" id="toggleConfirmPassword" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-600 hover:text-gray-800 focus:outline-none">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <div class="invalid-feedback text-red-500 text-sm px-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </x-form>
        </div> 
    </div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Password toggle
        const togglePassword = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        
        if (togglePassword) {
            togglePassword.addEventListener('click', function() {
                // Toggle type
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Toggle icon
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }
        
        // Confirm password toggle
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmPassword = document.getElementById('password_confirmation');
        
        if (toggleConfirmPassword) {
            toggleConfirmPassword.addEventListener('click', function() {
                // Toggle type
                const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPassword.setAttribute('type', type);
                
                // Toggle icon
                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        }
    });
</script>