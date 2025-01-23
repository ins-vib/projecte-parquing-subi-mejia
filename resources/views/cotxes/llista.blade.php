<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cotxes
        </h2>
    </x-slot>

    <div style="margin: 1%">
        <button><a href="/cotxes/afegir/admin" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Afegir Cotxe</a></button>
    </div>

    <div class="p-4 w-full">
        <form action="/cotxes" method="GET">
            <input style="border-radius: 10px" class="w-full" type="text" name="buscar" placeholder="Busca per matrícula, marca o cotxe" 
                   class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                   value="{{ request('buscar') }}">
        </form>
    </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">Matricula</th>
                <th scope="col" class="px-6 py-3">Marca</th>
                <th scope="col" class="px-6 py-3">Model</th>
                <th scope="col" class="px-6 py-3">Usuari</th>
                <th scope="col" class="px-6 py-3">Eliminar</th>
            </tr>
        </thead>
        <tbody >
            @foreach($cotxes as $cotxe)
                <tr>
                    <td class="px-6 py-4">{{$cotxe->matricula}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$cotxe->marca_cotxe}}</td>
                    <td class="px-6 py-4">{{$cotxe->model_cotxe}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$cotxe->user->name}}</td>
                    <td class="px-6 py-4 font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><a href="/cotxes/eliminar/admin/{{$cotxe->id}}">Eliminar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
 {{ $cotxes->links() }}
</div>

</x-app-layout>
