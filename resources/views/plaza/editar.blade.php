<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar plaça
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
                    Edita la plaça
                </h1>

                @if(session('error'))
                    <div class="text-red-500 text-sm text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('plaza.editar', $plaza->id) }}" class="space-y-4">
                    @csrf
                    @method('POST')

                    <div>
                        <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Numero de la plaça:</label>
                        <input type="text" name="numero" id="numero" value="{{ $plaza->numero }}" readonly class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    </div>

                    <div>
                        <label for="tipus_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipus de plaça:</label>
                        <select name="tipus_id" id="tipus_id" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            @foreach($tipus as $t)
                                <option value="{{ $t->id }}" {{ $plaza->tipus_id == $t->id ? 'selected' : '' }}>
                                    {{ $t->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700">
                        Desa canvis
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
