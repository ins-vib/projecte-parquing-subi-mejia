<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aparcar
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
                @if($parking->tipus_id == 2)
                <tr>
                    <td class="px-6 py-4">{{$parking->name}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"> {{$parking->address}}, {{$parking->ciutat}}</td>
                    <td class="px-6 py-4">{{$parking->capacitat}}</td>
                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800"> {{$parking->capacitat - $parking->plaçes_ocupades}}</td>
                    @if ($parking->plaçes_ocupades != $parking->capacitat)
                    <td><a href="/aparcar/cotxes/{{$parking->id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aparcar</a></td>
                    @else <td>PARKING PLE</td>
                    @endif 
                </tr>
                <tr>
                    <td colspan="5">
                        @if ($parking->imatges->isNotEmpty())
                        <div 
                            x-data="{
                                images: {{ $parking->imatges->pluck('path') }},
                                currentIndex: 0,
                                next() {
                                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                                },
                                startCarousel() {
                                    setInterval(() => { this.next(); }, 2000);
                                }
                            }" 
                            x-init="startCarousel"
                            class="w-full overflow-hidden"
                        >
                            <div class="flex w-full space-x-4 overflow-x-auto p-4">
                                <template x-for="(image, index) in images" :key="index">
                                    <div 
                                        x-show="index === currentIndex"
                                        class="min-w-[300px] max-w-[300px] rounded shadow-lg"
                                    >
                                        <img :src="'/storage/' + image" class="object-cover w-full h-48 rounded">
                                    </div>
                                </template>
                            </div>
                        </div>
                        <br>
                        <hr class="border-0 h-1 bg-blue-600"/>
                        @else
                        <div class="p-4 text-center text-gray-500 italic">
                            Aquest pàrquing no té imatges.
                        </div>
                        <br>
                            <hr class="border-0 h-1 bg-blue-600"/>
                        @endif
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>


</x-app-layout>