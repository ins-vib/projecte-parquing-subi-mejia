<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestió de parkings</title>
    @vite('resources/css/app.css') <!-- Assegura't que Vite està configurat -->
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-8">Gestió de parkings</h1>
        <div class="flex justify-center gap-6">
            <a href="{{ route('login') }}"
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
               Iniciar sessió
            </a>
            <a href="{{ route('register') }}"
               class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-200">
               Registrar-se
            </a>
        </div>
    </div>
</body>
</html>
