<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cotxes
        </h2>
    </x-slot>

    <div class="p-4 w-full max-w-md">
        <form action="/aparcar/cotxes/operador/{{$parking->id}}" method="GET" class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" name="buscar" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Busca per matrícula, marca o cotxe" value="{{ request('buscar') }}" required>
            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
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
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"><a href="/aparcar/operador/cotxes/{{$parking->id}}/plantes/{{$cotxe->id}} " class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aparcar</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
 {{ $cotxes->links() }}
</div>

</x-app-layout>
