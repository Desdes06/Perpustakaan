<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
    @vite('resources/css/font.css')
</head>
<body>
    <div class="flex">
        <div class="text-white h-screen w-3/5 relative p-9"
             style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('img/book.jpg'); background-size: cover; background-position: center; hover:fill-gray-300">
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
            <x-form action="/login" method="POST" title="login" buttonText="Login">
                @csrf
                <div>
                    <label for="credential" class="text-md p-4">Masukan Email atau Username</label><br>
                    <input type="text" name="credential" id="credential" class="rounded-full border-black p-4 w-full hover:bg-gray-400 hover:placeholder-white outline-none" placeholder="Email atau Username" autofocus required 
                        @error('credential') 
                            is-invalid 
                        @enderror> 
                    @error('credential')
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
            <p>Punya Akun?<a href="/registrasi" class="px-2 text-blue-500">Registrasi</a></p> 
        </div> 
    </div>
</body>
</html>