<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Parkings') }}
        </h2>
    </x-slot>


<a href="/parkings/afegir">Afegir Parking</a>
    
<br>
editar parking


<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3"> Adreça</th>
                <th scope="col" class="px-6 py-3">Ciutat</th>
                <th scope="col" class="px-6 py-3">Capacitat</th>
                <th scope="col" class="px-6 py-3">Hora Obertura</th>
                <th scope="col" class="px-6 py-3">Hora Tancament</th>
                <th scope="col" class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody >
            @foreach($parkings as $parking)
            <tr >
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$parking->id}}</td>
                <td class="px-6 py-4">{{$parking->name}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$parking->address}}</td>
                <td class="px-6 py-4">{{$parking->ciutat}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$parking->capacitat}}</td>
                <td class="px-6 py-4">{{$parking->horaObertura}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$parking->horaTancament}}</td>
                <td class="font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="/parkings/informacio/{{$parking->id}}">Mostrar Informació</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


</x-app-layout>
