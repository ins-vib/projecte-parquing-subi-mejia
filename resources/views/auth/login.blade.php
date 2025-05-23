<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sessió</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex flex-col items-center justify-center min-h-screen gap-6">
    <div>
        <svg height='50px' width='50px' version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#E6E6E6;" d="M464.058,9.291H47.944c-21.348,0-38.653,17.305-38.653,38.653v416.113 c0,21.348,17.305,38.653,38.653,38.653h416.113c21.348,0,38.653-17.305,38.653-38.653V47.944 C502.711,26.596,485.405,9.291,464.058,9.291z"></path> <rect x="60.632" y="60.629" style="fill:#47A7DD;" width="390.742" height="390.754"></rect> <g> <polygon style="fill:#6AC7EF;" points="369.548,60.629 118.889,451.378 60.632,451.378 60.632,371.071 259.774,60.629 "></polygon> <polygon style="fill:#6AC7EF;" points="451.369,60.629 451.369,110.774 232.873,451.378 175.682,451.378 426.341,60.629 "></polygon> </g> <path style="fill:#E6E6E6;" d="M263.758,110.328h-15.062h-15.748h-48.819v291.345h64.568v-83.669h15.062 c57.348,0,103.838-46.489,103.838-103.838l0,0C367.595,156.817,321.106,110.328,263.758,110.328z M307.752,214.165 c0,26.036-21.107,47.143-47.143,47.143h-11.913v-94.287h11.913C286.645,167.022,307.752,188.129,307.752,214.165L307.752,214.165z"></path> <path d="M462.662,0H49.339C22.133,0,0,22.133,0,49.339v328.305c0,5.131,4.159,9.291,9.291,9.291s9.291-4.16,9.291-9.291V49.339 c0-16.96,13.799-30.757,30.757-30.757h413.323c16.959,0,30.757,13.797,30.757,30.757v413.323c0,16.96-13.799,30.757-30.757,30.757 H49.339c-16.959,0-30.757-13.797-30.757-30.757v-52.932c0-5.131-4.159-9.291-9.291-9.291S0,404.598,0,409.729v52.932 C0,489.867,22.133,512,49.339,512h413.323C489.867,512,512,489.867,512,462.661V49.339C512,22.133,489.867,0,462.662,0z"></path> <path d="M352.26,51.338H60.629c-5.132,0-9.291,4.16-9.291,9.291v390.743c0,5.131,4.159,9.291,9.291,9.291h390.743 c5.132,0,9.291-4.16,9.291-9.291V60.629c0-5.131-4.159-9.291-9.291-9.291h-67.024c-5.132,0-9.291,4.16-9.291,9.291 s4.159,9.291,9.291,9.291h57.734v372.161H69.919V69.919h282.34c5.132,0,9.291-4.16,9.291-9.291S357.392,51.338,352.26,51.338z"></path> <path d="M184.128,340.116c-5.132,0-9.291,4.16-9.291,9.291v52.266c0,5.131,4.159,9.291,9.291,9.291h64.568 c5.132,0,9.291-4.16,9.291-9.291v-74.379h5.771c62.379,0,113.128-50.749,113.128-113.128s-50.749-113.128-113.128-113.128h-79.63 c-5.132,0-9.291,4.16-9.291,9.291V317.32c0,5.131,4.159,9.291,9.291,9.291c5.132,0,9.291-4.16,9.291-9.291V119.618h70.339 c52.133,0,94.547,42.414,94.547,94.547s-42.414,94.547-94.547,94.547h-15.062c-5.132,0-9.291,4.16-9.291,9.291v74.379h-45.986 v-42.975C193.419,344.276,189.259,340.116,184.128,340.116z"></path> <path d="M248.696,270.599h11.912c31.118,0,56.435-25.316,56.435-56.434s-25.318-56.434-56.435-56.434h-11.912 c-5.132,0-9.291,4.16-9.291,9.291v94.287C239.405,266.44,243.564,270.599,248.696,270.599z M257.986,176.313h2.621 c20.873,0,37.854,16.981,37.854,37.853s-16.981,37.853-37.854,37.853h-2.621V176.313z"></path> </g></svg>
    </div>
    <div class="w-full max-w-md bg-white shadow-md rounded-xl p-8">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Inicia sessió</h2>

        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700">Correu electrònic</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                       class="w-full mt-1 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Contrasenya</label>
                <input type="password" name="password" required
                       class="w-full mt-1 px-4 py-2 border rounded-md shadow-sm focus:ring focus:ring-blue-300" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2">
                    <span class="text-sm text-gray-600">Recorda'm</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                        Has oblidat la contrasenya?
                    </a>
                @endif
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                Inicia sessió
            </button>

            <div class="text-center text-sm mt-4">
                Encara no tens compte?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Registra't</a>
            </div>
        </form>
    </div>

</body>
</html>
