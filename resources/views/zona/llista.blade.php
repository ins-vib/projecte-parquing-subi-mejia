<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Plantes
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

<div style="margin: 1%">
    <a href="/plantes/afegir" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Afegir planta</a> 
</div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">Parking</th>
                <th scope="col" class="px-6 py-3">Planta</th>
                <th scope="col" class="px-6 py-3">Capacitat Planta</th>
                <th scope="col" class="px-6 py-3">Estat</th>
                <th scope="col" colspan="3" class="px-6 py-3">Mostrar Plaçes</th>
            </tr>
        </thead>
        <tbody >
            @foreach($plantes as $planta)
            <tr >
                <td class="px-6 py-4">{{$planta->parking->name}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$planta->nom}}</td>
                <td class="px-6 py-4">{{$planta->capacitatTotal}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                    @if ($planta->estat == 1)
                        Obert
                        @else Tancat
                    @endif
                </td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="{{ route('plaza.planta', ['id' => $planta->id]) }}">Plaçes</a></td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="{{ route('zona.editar', ['id' => $planta->id]) }}">Editar Planta</a></td>
                <td class="px-6 py-4font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><a href="{{ route('zona.eliminar', ['id' => $planta->id]) }}">Eliminar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
 {{ $plantes->links() }}
</div>

</x-app-layout>
