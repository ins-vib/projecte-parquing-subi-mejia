<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Vehículos') }}
        </h2>
    </x-slot>


<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Adreça</th>
            <th>Ciutat</th>
            <th>Capacitat</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Hora Obertura</th>
            <th>Hora Tancament</th>
        </tr>
    </thead>
    <tbody >
        @foreach($parkings as $parking)
        <tr >
            <td>{{$parking->id}}</td>
            <td>{{$parking->name}}</td>
            <td>{{$parking->address}}</td>
            <td>{{$parking->ciutat}}</td>
            <td>{{$parking->capacitat}}</td>
            <td>{{$parking->latitud}}</td>
            <td>{{$parking->longitud}}</td>
            <td>{{$parking->horaObertura}}</td>
            <td>{{$parking->horaTancament}}</td>
            <td><a href="/parkings/informacio/{{$parking->id}}">Mostrar Informació</a></td>
        </tr>
        @endforeach
    </tbody>
</table>


</x-app-layout>
