<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Afegir planta
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

    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
        <div style="margin: 1%" class="w-full bg-white rounded-lg shadow dark:border sm:max-w-2xl xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                    Afegeix una nova zona
                </h1>

                @if(session('error'))
                    <div class="text-red-500 text-sm text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('zona.afegir') }}" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom de la Zona:</label>
                        <input type="text" name="nom" id="nom" value="{{ old('nom') }}" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="parking_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pàrquing:</label>
                        <select name="parking_id" id="parking_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <option value="">Selecciona un pàrquing</option>
                            @foreach($parkings as $parking)
                                <option value="{{ $parking->id }}" {{ old('parking_id') == $parking->id ? 'selected' : '' }}>
                                    {{ $parking->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="capacitatTotal" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Capacitat Total:</label>
                        <input type="number" name="capacitatTotal" id="capacitatTotal" value="{{ old('capacitatTotal') }}" min="1" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        @foreach($tipusPlaces as $tipus)
                            <div>
                                <label class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $tipus->nom }}
                                </label>
                                <input 
                                    type="number" 
                                    name="quantitat[{{ $tipus->id }}]" 
                                    min="0"
                                    value="0"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Quantitat de places per a {{ $tipus->nom }}"
                                >
                            </div>
                        @endforeach
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                        Crear Zona
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
