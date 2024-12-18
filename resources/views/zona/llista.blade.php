<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalls de la {{$zonas->nom}}
        </h2>
    </x-slot>

<table>
    <tr>
        <td><strong>Id</strong> </td>
        <td>{{$zonas->id}}</td>
    </tr>  
</table>
</x-app-layout>
