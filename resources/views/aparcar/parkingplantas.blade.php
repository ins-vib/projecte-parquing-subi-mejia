<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aparcar {{$parking->name}}, plantes
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">Planta</th>
                    <th scope="col" class="px-6 py-3">Capacitat Planta</th>
                    <th scope="col" colspan="3" class="px-6 py-3">Mostrar Plaçes</th>
                </tr>
            </thead>
            <tbody >
                @foreach($plantes as $planta)
                <tr >
                    <td class="px-6 py-4">{{$planta->nom}} </td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$planta->capacitatTotal}}</td>
                    <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="/aparcar/cotxes/{{$parking->id}}/plantes/{{$cotxe->id}}/{{$planta->id}}">Plaçes</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
