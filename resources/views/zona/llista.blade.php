<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Parkings') }}
        </h2>
    </x-slot>

<h2>Detalls de la {{$zonas->nom}}</h2>

<table>
    <tr>
        <td><strong>Id</strong> </td>
        <td>{{$zonas->id}}</td>
    </tr>  
    <tr>
        <td><strong>Nom</strong> </td>
        <td>{{$zonas->nom}}</td>
    </tr>
    <tr>
        <td><strong>Estat</strong> </td>
        <td>{{$zonas->nom}}</td>
    </tr>    
</table>
</x-app-layout>
