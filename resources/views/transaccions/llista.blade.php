<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Transaccions
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

    <div class="max-w-4xl mx-auto my-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
                    <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                        <tr>
                            <th scope="col" class="px-6 py-3">id transaccio</th>
                            <th scope="col" class="px-6 py-3">Cotxe</th>
                            <th scope="col" class="px-6 py-3">Planta</th>
                            <th scope="col" class="px-6 py-3">Plaça</th>
                            <th scope="col" class="px-6 py-3">Entrada</th>
                            <th scope="col" class="px-6 py-3">Sortida</th>
                            <th scope="col" class="px-6 py-3">Import</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaccions as $transaccio)
                        <tr>
                            <td class="px-6 py-4">{{$transaccio->id}}</td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$transaccio->cotxe?->matricula}}</td>
                            <td class="px-6 py-4">{{$transaccio->plaza->zona->nom}}</td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$transaccio->plaza->numero}}</td>
                            <td class="px-6 py-4">{{$transaccio->hora_entrada}}</td>
                            <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$transaccio->hora_sortida}}</td>
                            <td class="px-6 py-4">{{$transaccio->import}}€</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>

</x-app-layout>