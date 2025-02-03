<x-app-layout>
    <x-slot name="capcalera">
        <h2>Llista parkings Examen</h2>
    </x-slot>
    
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Estat</th>
                <th>Adreça</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parkings as $parking)
            <tr id="parking-{{$loop->index}}" onclick="mostraAdreca({{$loop->index}})">
                <td>{{$parking->name}}</td>
                <td>
                    @if(Carbon\Carbon::now()->between($parking->horaObertura, $parking->horaTancament))
                        ✅ Obert 
                        @else ❌ Tancat 
                    @endif
                </td>
                <td id="adreca-{{$loop->index}}" class="hidden">{{$parking->address}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <script>
        function mostraAdreca(id) { 
            document.getElementById("adreca-" + id).classList.toggle("hidden");
        }
    </script>
</x-app-layout>