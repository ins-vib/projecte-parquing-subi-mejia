<x-app-layout>
    <x-slot name="header">
    <a href="{{ url()->previous() }}" >Tornar</a>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Plaçes {{$planta->nom}}
        </h2>
    </x-slot>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
        <label for="table-search" class="sr-only">Search</label>
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
                <td class="px-6 py-4">{{$plaça->tipusplaça->nom}}</td>
                <td class="px-6 py-4" style="border: solid black 1px; background-color: {{ $plaça->estat ? 'green' : 'red' }};"></td>
            @endforeach
            
        </tbody>
        
    </table>
</div>
<div>
 {{ $plaçes->links() }}
</div>


</x-app-layout>