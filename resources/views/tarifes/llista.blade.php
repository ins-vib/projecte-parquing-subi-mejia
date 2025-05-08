<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Tarifes
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto my-4">
        <div class="mb-4">
            <a href="/tarifes/afegir" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Afegir Tarifa
            </a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
                <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                    <tr>
                        <th scope="col" class="px-6 py-3">id Tarifa</th>
                        <th scope="col" class="px-6 py-3">Preu</th>
                        <th scope="col" class="px-6 py-3">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tarifes as $tarifa)
                    <tr>
                        <td class="px-6 py-4">{{$tarifa->id}}</td>
                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$tarifa->preu}}€/h</td>
                        <td class="px-6 py-4font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><a href="/tarifes/eliminar/{{$tarifa->id}}">Eliminar</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>