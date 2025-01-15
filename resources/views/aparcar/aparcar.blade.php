<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aparcar
        </h2>
    </x-slot>

    <p class="px-6 py-3">APARCAMENT LLIURE</p>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">Nom Parking</th>
                    <th scope="col" class="px-6 py-3">Ubicació</th>
                    <th scope="col" class="px-6 py-3">Plaçes Totals</th>
                    <th scope="col" class="px-6 py-3">Plaçes Disponibles</th>
                    <th scope="col" class="px-6 py-3">Aparcar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parkings as $parking)
                @if($parking->tipus_id == 1)
                <tr>
                    <td class="px-6 py-4">{{$parking->name}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"> {{$parking->address}}, {{$parking->ciutat}}</td>
                    <td class="px-6 py-4">{{$parking->capacitat}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"> {{$parking->capacitat - $parking->plaçes_ocupades}}</td>

                    <td><a href="/aparcar/tipus1/{{$parking->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aparcar</a></td> 
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <br>
    <br>

    <p class="px-6 py-3">SELECCIONA EL PARKING ON APARCAR AMB EL TEU VEHICLE</p>
        
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="margin: 1%">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-black">
            <thead class="text-xs text-white uppercase bg-blue-600 dark:text-white">
                <tr>
                    <th scope="col" class="px-6 py-3">Nom Parking</th>
                    <th scope="col" class="px-6 py-3">Ubicació</th>
                    <th scope="col" class="px-6 py-3">Plaçes Totals</th>
                    <th scope="col" class="px-6 py-3">Plaçes Disponibles</th>
                    <th scope="col" class="px-6 py-3">Aparcar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($parkings as $parking)
                @if($parking->tipus_id != 1)
                <tr>
                    <td class="px-6 py-4">{{$parking->name}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"> {{$parking->address}}, {{$parking->ciutat}}</td>
                    <td class="px-6 py-4">{{$parking->capacitat}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"> {{$parking->capacitat - $parking->plaçes_ocupades}}</td>
                    <td><a href="/aparcar/cotxes" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aparcar</a></td> 
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>


</x-app-layout>