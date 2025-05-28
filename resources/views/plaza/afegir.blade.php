<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Afegir plaça
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

    <div class="flex justify-center mt-8">
        <div class="w-full max-w-xl bg-white dark:bg-gray-800 shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @if(session('error'))
                <div class="mb-4 text-sm text-red-600 dark:text-red-400">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('plaza.afegir') }}">
                @csrf

                <div class="mb-4">
                    <label for="zona_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Zona:</label>
                    <select name="zona_id" id="zona_id" required class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                        <option value="">Selecciona una zona</option>
                        @foreach($zones as $zona)
                            <option value="{{ $zona->id }}">{{ $zona->nom }} ({{ $zona->parking->name }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tipus_id" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Tipus de plaça:</label>
                    <select name="tipus_id" id="tipus_id" required class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                        @foreach($tipusPlaces as $tipus)
                            <option value="{{ $tipus->id }}">{{ $tipus->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="numero" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Número de plaça:</label>
                    <input type="number" name="numero" id="numero" required min="1" class="w-full rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Afegir plaça
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
