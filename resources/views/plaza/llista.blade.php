<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Plaçes
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
    <div style="margin: 1%">
        <a href="/plaçes/afegir" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Afegir plaça</a> 
    </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
        <label for="table-search" class="sr-only">Search</label>
            <tr>
                <th scope="col" class="px-6 py-3">Numero Plaça</th>
                <th scope="col" class="px-6 py-3">id Planta</th>
                <th scope="col" class="px-6 py-3">Tipus</th>
                <th scope="col" class="px-6 py-3" colspan="3">Estat</th>
            </tr>
        </thead>
        <tbody >
            @foreach($plaçes as $plaça)
            <tr data-placa-id="{{ $plaça->id }}" data-bloquejat="{{ $plaça->bloquejat }}" oncontextmenu="mostrarMenu(event, this)">
                <td class="px-6 py-4">{{$plaça->numero}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$plaça->zona_id}}</td>
                <td class="px-6 py-4">{{$plaça->tipusplaça->nom}}</td>
                <td class="px-6 py-4 text-white font-bold text-center" style="border: solid black 1px; background-color: {{ $plaça->bloquejat ? 'red' : ($plaça->estat ? 'green' : 'red') }};">{{ $plaça->bloquejat ? 'Bloquejat' : '' }}</td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="{{ route('plaza.editar', ['id' => $plaça->id]) }}">Editar</a></td>
                <td class="px-6 py-4font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><a href="{{ route('plaza.eliminar', ['id' => $plaça->id]) }}">Eliminar</a></td>
            @endforeach
            
        </tbody>
        
    </table>
</div>
<div>
 {{ $plaçes->links() }}
</div>

<div id="menuBloqDesbloq" class="hidden fixed bg-white border rounded shadow-md z-50">
    <ul>
        <li id="canviEstat" class="px-4 py-2 hover:bg-gray-200 cursor-pointer">Bloquejar/Desbloquejar</li>
    </ul>
</div>

<script>
    let columnaSeleccionada = null;

    function mostrarMenu(event, row) {
        event.preventDefault();
        columnaSeleccionada = row;

        const menu = document.getElementById('menuBloqDesbloq');
        menu.style.top = event.pageY + 'px';
        menu.style.left = event.pageX + 'px';
        menu.classList.remove('hidden');
    }

    window.addEventListener('click', (e) => {
        const menu = document.getElementById('menuBloqDesbloq');
        if (!menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    document.getElementById('canviEstat').addEventListener('click', function () {
        if (!columnaSeleccionada) return;

        const placaId = columnaSeleccionada.getAttribute('data-placa-id');
        const bloquejatActual = parseInt(columnaSeleccionada.getAttribute('data-bloquejat'));
        const nouEstat = bloquejatActual === 1 ? 0 : 1;

        fetch('/plaçes/' + placaId + '/bloq', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ bloquejat: nouEstat })
        })
        .then(response => response.json())
        .then(data => {
            location.reload();
        });
    });
</script>

</x-app-layout>
