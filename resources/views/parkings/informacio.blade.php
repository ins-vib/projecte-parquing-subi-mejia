<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalls de {{$parkings->name}}
        </h2>
    </x-slot>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <tr>
            <td ><strong>Id</strong> </td>
            <td>{{$parkings->id}}</td>
        </tr>
        <tr>
            <td><strong>Nom Parking</strong> </td>
            <td>{{$parkings->name}}</td>
        </tr>
        <tr>
            <td><strong>Adressa Parking</strong> </td>
            <td>{{$parkings->address}}</td>
        </tr>
        <tr>
            <td><strong>Ciutat</strong> </td>
            <td>{{$parkings->ciutat}}</td>
        </tr>
        <tr>
            <td><strong>Capacitat Parking</strong> </td>
            <td>{{$parkings->capacitat}}</td>
        </tr>
        <tr>
            <td><strong>Latitud i Longitud</strong> </td>
            <td>{{$parkings->latitud}}</td>
            <td>{{$parkings->longitud}}</td>
        </tr>
        <tr>
            <td><strong>Hores Obertura i Tancament</strong> </td>
            <td>{{$parkings->horaObertura}}</td>
            <td>{{$parkings->horaTancament}}</td>
        </tr>
        
    </table>
</div>

<br>

Zona del parking:

<table>
    @foreach($zonas as $zona)
    <tr >
        <td><a href="/plantes/llista/{{$zona->id}}">{{$zona->nom}}</a></td>
    </tr>
    @endforeach
</table>

</x-app-layout>