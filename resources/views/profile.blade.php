<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/css/font.css')
</head>
<body>
    <div class="flex p-4">
        <div class="w-3/5">
            <img class="h-8 w-auto px-4" src="https://tailwindui.com/plus/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
        </div>
        <div class="flex justify-center items-center w-3/5">
            <div class="flex items-center space-x-2">
                <button>Pinjam</button>
                <button>Riwayat</button>
            </div>
        </div>
    </div>
</body>
</html>