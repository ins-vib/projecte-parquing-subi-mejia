<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Plantes
        </h2>
    </x-slot>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">Numero Plaça</th>
                <th scope="col" class="px-6 py-3">id Planta</th>
                <th scope="col" class="px-6 py-3">Tipus</th>
                <th scope="col" class="px-6 py-3">Estat</th>
            </tr>
        </thead>
        <tbody >
            @foreach($plaçes as $plaça)
            <tr >
                <td class="px-6 py-4">{{$plaça->numero}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$plaça->zona_id}}</td>
                <td class="px-6 py-4">{{$plaça->tipus}}</td>
                <td class="px-6 py-4" style="border: solid black 1px; background-color: {{ $plaça->estat ? 'green' : 'red' }};"></td>
            @endforeach
        </tbody>
    </table>
</div>

</x-app-layout>
