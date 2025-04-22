<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Under Maintenance - HMTIF UMRI</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Courier+Prime&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
        }
        .heading {
            font-family: 'Anton', sans-serif;
        }
        .monospace {
            font-family: 'Courier Prime', monospace;
        }
        .gear-spin {
            animation: spin 8s linear infinite;
        }
        .gear-spin-reverse {
            animation: spin-reverse 8s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes spin-reverse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(-360deg); }
        }
        .progress-animation {
            width: 0%;
            animation: progress 5s ease-in-out infinite;
        }
        @keyframes progress {
            0% { width: 15%; }
            50% { width: 85%; }
            100% { width: 15%; }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <header class="bg-yellow-400 border-b-4 border-black">
        <div class="container mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center">
                <div class="bg-black text-white p-2 rotate-3 transform">
                    <span class="heading text-xl tracking-tight">HMTIF</span>
                </div>
                <span class="ml-2 text-black font-bold">UMRI</span>
            </div>
            <div class="monospace bg-black text-white px-3 py-1 text-sm">
                MAINTENANCE MODE
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl w-full">
            <div class="text-center mb-12">
                <h1 class="heading text-5xl sm:text-6xl md:text-7xl text-black mb-4 uppercase">
                    <span class="bg-pink-500 px-4 py-2 inline-block transform -rotate-2 border-4 border-black">
                        We're<br class="md:hidden"> Upgrading!
                    </span>
                </h1>
                <p class="monospace text-lg md:text-xl bg-black text-white inline-block px-4 py-2 transform rotate-1">
                    {{ now()->format('d F Y - H:i') }} WIB
                </p>
            </div>

            <div class="bg-white border-4 border-black p-6 md:p-8 mb-8 relative">
                <div class="absolute -top-4 -right-4 bg-yellow-400 h-8 w-8 border-4 border-black"></div>
                <div class="absolute -bottom-4 -left-4 bg-pink-500 h-8 w-8 border-4 border-black"></div>
                
                <div class="flex flex-col md:flex-row gap-8 items-center">
                    <div class="md:w-1/3 relative flex justify-center">
                        <i class="fas fa-cog text-gray-800 text-8xl gear-spin"></i>
                        <i class="fas fa-cog text-pink-500 text-6xl absolute top-1/2 left-1/2 transform -translate-x-16 -translate-y-1/2 gear-spin-reverse"></i>
                        <i class="fas fa-cog text-yellow-400 text-5xl absolute top-1/2 left-1/2 transform translate-x-10 translate-y-6 gear-spin"></i>
                    </div>
                    
                    <div class="md:w-2/3">
                        <h2 class="heading text-2xl md:text-3xl mb-4">WEBSITE SEDANG DIPERBAIKI</h2>
                        <p class="mb-4">
                            Mohon maaf atas ketidaknyamanannya. Website HMTIF UMRI sedang dalam perbaikan untuk meningkatkan performa dan pengalaman pengguna.
                        </p>
                        <p class="mb-6">
                            Kami akan segera kembali dengan fitur yang lebih baik dan pengalaman yang lebih menyenangkan!
                        </p>
                        
                        <div class="w-full bg-gray-200 h-4 rounded-full overflow-hidden border-2 border-black">
                            <div class="bg-pink-500 h-full progress-animation"></div>
                        </div>
                        <p class="text-sm text-gray-600 text-center mt-2 monospace">
                            Estimasi: Kembali online dalam 24 jam
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="bg-lime-300 border-4 border-black p-6 transform rotate-1">
                <h3 class="heading text-xl mb-4">TETAP TERHUBUNG DENGAN KAMI</h3>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a target="_blank" href="https://www.instagram.com/hmtifumri/" class="bg-black text-white px-4 py-2 flex items-center gap-2 hover:bg-gray-800 transition-colors">
                        <i class="fab fa-instagram"></i>
                        <span>@HMTIFUMRI</span>
                    </a>
                    <a target="_blank" href="https://wa.me/6283173633639" class="bg-black text-white px-4 py-2 flex items-center gap-2 hover:bg-gray-800 transition-colors">
                        <i class="fab fa-whatsapp"></i>
                        <span>Contact Admin</span>
                    </a>
                    <a target="_blank" href="mailto:hmtifumriofficial@gmail.com" class="bg-black text-white px-4 py-2 flex items-center gap-2 hover:bg-gray-800 transition-colors">
                        <i class="far fa-envelope"></i>
                        <span>hmtifumriofficial@gmail.com</span>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-black text-white py-4 mt-auto">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="monospace text-sm">
                &copy; {{ date('Y') }} Himpunan Mahasiswa Teknik Informatika (HMTIF) UMRI
            </p>
        </div>
    </footer>
</body>
</html>