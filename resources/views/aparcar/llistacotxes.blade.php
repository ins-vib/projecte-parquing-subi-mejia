<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista Cotxes
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

    <p class="px-6 py-3">ESCULL AMB EL COTXE QUE VOLS APARCAR</p>

    <div style="margin: 1%">
        <button><a href="/aparcar/afegir" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Afegir Cotxe</a></button>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">Matricula</th>
                    <th scope="col" class="px-6 py-3">Marca del Cotxe</th>
                    <th scope="col" class="px-6 py-3">Model del cotxe</th>
                    <th scope="col" colspan="2" class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody >
                @foreach($cotxes as $cotxe)
                <tr >
                    <td class="px-6 py-4">{{$cotxe->matricula}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$cotxe->marca_cotxe}}</td>
                    <td class="px-6 py-4">{{$cotxe->model_cotxe}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"><a href="/aparcar/cotxes/{{$parking->id}}/plantes/{{$cotxe->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aparcar</a></td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"><a  class="px-6 py-4 bg-gray-50 dark:bg-gray-800 font-medium text-red-600 dark:text-red-500 hover:underline ms-3" href="/cotxes/eliminar/{{$cotxe->id}}">Eliminar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>