<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Plaçes per aparcar:
        </h2>
        <h1>
            <div id="clock" style="color: rgb(134, 125, 125); text-align: left;"></div>
            <script>
                function updateClock() {
                    let options = { timeZone: 'Europe/Madrid', hour: '2-digit', minute: '2-digit', second: '2-digit' };
                    let now = new Date().toLocaleTimeString('ca-ES', options);
                    document.getElementById('clock').textContent = now;
                }
                setInterval(updateClock, 1000);
                updateClock();
            </script>
        </h1>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
        @if ($errors->any())
            <div class="bg-red-200 text-red-700 p-2 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
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
                        @if ($plaça->bloquejat)
                        <span class="text-red-600">Plaça bloquejada</span>
                        @elseif ($plaça->estat)
                            <form method="POST" action="/aparcar/{{$plaça->id}}">
                                @csrf
                                <input type="hidden" name="cotxe_id" value="{{ $cotxe->id }}">
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                                    Aparcar
                                </button>
                            </form>
                            @elseif($plaça->cotxe ) 
                                <span>{{ $plaça->cotxe->matricula }}</span>

                                @if($plaça->cotxe && $plaça->cotxe->user_id == auth()->user()->id)
                                    <form method="POST" action="/desaparcar/{{$plaça->id}}" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">
                                            Desaparcar
                                        </button>
                                    </form>
                                @endif
                        @endif
                    </td>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>