<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Parkings') }}
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

<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <style>
        #map {
            height: 400px;
            width: 90%;
            margin: auto;
        }
    </style>
</head>

<div style="margin: 1%">
    <a href="/parkings/afegir" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Afegir Parking</a> 
</div>


<div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
        <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">Nom</th>
                <th scope="col" class="px-6 py-3">Adreça</th>
                <th scope="col" class="px-6 py-3">Ciutat</th>
                <th scope="col" class="px-6 py-3">Capacitat</th>
                <th scope="col" class="px-6 py-3">Hora Obertura</th>
                <th scope="col" class="px-6 py-3">Hora Tancament</th>
                <th scope="col" class="px-6 py-3">Tipus Parking</th>
                <th scope="col" class="px-6 py-3">Tarifa</th>
                <th scope="col" colspan="3" class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody >
            @foreach($parkings as $parking)
            <tr >
                <td class="px-6 py-4">{{$parking->name}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$parking->address}}</td>
                <td class="px-6 py-4">{{$parking->ciutat}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$parking->capacitat}}</td>
                <td class="px-6 py-4">{{$parking->horaObertura}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">{{$parking->horaTancament}}</td>
                <td class="px-6 py-4">{{$parking->tipus_id}}</td>
                <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                    @if($parking->tarifa)
                        {{$parking->tarifa->preu}}€/h
                    @else
                        Sense tarifa
                    @endif
                </td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="/parkings/informacio/{{$parking->id}}">Mostrar Informació</a></td>
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-500 hover:underline"><a href="/parkings/editar/{{$parking->id}}">Editar Informació</a></td>
                <td class="px-6 py-4font-medium text-red-600 dark:text-red-500 hover:underline ms-3"><a href="/parkings/eliminar/{{$parking->id}}">Eliminar</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div>
 {{ $parkings->links() }}
</div>


<body>
    <div id="map" style="border-radius: 20px"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script>
        const map = L.map('map').setView([41.57235, 1.53235], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        @foreach($parkings as $parking)
            L.marker([{{ $parking->latitud }}, {{ $parking->longitud }}]).addTo(map)
                .bindPopup('<a href="/parkings/informacio/{{$parking->id}}">{{ $parking->name }}</a> <p>Capacitat: {{$parking->capacitat}} </p> <p>Plaçes lliures: {{$parking->capacitat - $parking->plaçes_ocupades}}</p>');
        @endforeach

    </script>
</body>


</x-app-layout>
