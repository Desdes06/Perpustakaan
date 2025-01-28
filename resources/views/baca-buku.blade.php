<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baca Buku</title>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.0.0/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist/build/pdf.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
    @vite('resources/css/font.css')
    <style>
        #pdf-viewer {
            width: 100%;
            height: 90vh;
            overflow: auto;
            border: 2px solid #ddd;
        }
        canvas {
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="space-y-4">
        <div class="bg-gray-900 px-8 p-4 flex justify-between items-center">
            <a href="/beranda">
                <button class="bg-gray-300 hover:bg-gray-400 hover:text-white p-2 rounded-md">kembali</button>
            </a>
            <h1 class="text-2xl font-bold text-center text-white">{{ $buku->judul_buku }}</h1>
            <img class="h-8" src="{{ asset('img/logo.png') }}" alt="Your Company" />
        </div>
        <div id="pdf-viewer"></div>
    </div>
    <script>
        const url = "{{ asset('storage/' . $buku->file_buku) }}";

        const pdfjsLib = window['pdfjs-dist/build/pdf'];

        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist/build/pdf.worker.min.js';

        const loadingTask = pdfjsLib.getDocument(url);
        loadingTask.promise.then(pdf => {
            const container = document.getElementById('pdf-viewer');

            for (let i = 1; i <= pdf.numPages; i++) {
                pdf.getPage(i).then(page => {
                    const viewport = page.getViewport({ scale: 1.5 });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');

                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    container.appendChild(canvas);

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport,
                    };
                    page.render(renderContext);
                });
            }
        }).catch(error => {
            console.error('Error loading PDF:', error);
        });
    </script>
</body>
</html>