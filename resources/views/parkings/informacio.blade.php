<x-app-layout>
    <x-slot name="header">
    <a href="/parkings" >Tornar</a>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Detalls de {{$parkings->name}}
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
        <td><a href="{{ route('plaza.planta', ['id' => $zona->id]) }}">{{$zona->nom}}</a></td>
    </tr>
    @endforeach
</table>

<h2 class="mt-10 text-xl font-semibold">Imatges del Parking</h2>
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @foreach($parkings->imatges as $imatge)
        <div class="border rounded overflow-hidden shadow">
            <img src="{{ asset('storage/' . $imatge->path) }}" alt="Imatge Parking" class="h-full w-auto object-cover">
        </div>
    @endforeach
</div>

<button><a href="{{ route('parkings.imatges', ['id' => $parkings->id]) }}">Pujar imatges</a></button>

</x-app-layout>