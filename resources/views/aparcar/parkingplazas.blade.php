<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Plaçes per aparcar:
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
            <label for="table-search" class="sr-only">Search</label>
                <tr>
                    <th scope="col" class="px-6 py-3">Numero Plaça</th>
                    <th scope="col" class="px-6 py-3">Estat</th>
                </tr>
            </thead>
            <tbody >
                @foreach($plaçes as $plaça)
                <tr >
                    <td class="px-6 py-4">{{$plaça->numero}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800" style="background-color: {{ $plaça->estat ? '' : 'red' }};">
                        @if ($plaça->estat)
                            <form method="POST" action="/aparcar/cotxes/plaçes/planta/{{$plaça->id}}">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Aparcar
                                </button>
                            </form>
                        @endif
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>