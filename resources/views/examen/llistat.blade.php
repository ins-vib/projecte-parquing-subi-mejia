<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Llistat de Pàrquings
        </h2>
        <h1>
            <div id="clock" style="color: rgb(134, 125, 125); text-align: left;"></div>
            <script>
                function updateClock() {
                    let options = { timeZone: 'Europe/Madrid', hour: '2-digit', minute: '2-digit', second: '2-digit' };
                    let now = new Date().toLocaleTimeString('ca-ES', options);
                    document.getElementById('clock').textContent = now;
                }
                setInterval(updateClock, 1000);
                updateClock();
            </script>
        </h1>
    </x-slot>

    <div style="margin: 1%" class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 style="text-align:center" class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Llistat de Pàrquings
                </h1>

                @foreach ($data as $parking)
                    <div class="p-4 border-b flex justify-between items-center">
                        <div class="text-lg font-semibold">
                            @if ($parking->is_open)
                                <span class="text-green-500">✅</span>
                                {{ $parking->name }} - <span class="text-green-600">Obert</span>
                                @if ($parking->has_free_spaces)
                                    | <span class="text-blue-600">Places disponibles</span>
                                @else
                                    | <span class="text-red-600">Plé</span>
                                @endif
                            @else
                                <span class="text-red-500">❌</span>
                                {{ $parking->name }} - <span class="text-red-600">Tancat</span>
                            @endif
                        </div>

                        @if ($parking->is_open && $parking->has_free_spaces)
                            <button onclick="toggleAddress({{ $parking->id }})" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Veure Adreça
                            </button>
                        @endif
                    </div>
                    <div id="address-{{ $parking->id }}" class="hidden p-3 bg-gray-100 text-gray-700 rounded">
                        📍 {{ $parking->address }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function toggleAddress(parkingId) {
            document.getElementById('address-' + parkingId).classList.toggle('hidden');
        }
    </script>
</x-app-layout>
