<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Aparcar {{$parking->name}}
        </h2>
    </x-slot>

    <div style="margin: 1%">
        Plaçes disponibles {{$parking->capacitat - $parking->plaçes_ocupades}}
        <br>

        <form method="POST" action="/aparcar/tipus1/{{$parking->id}}">
            @csrf
            @if($parking->capacitat > $parking->plaçes_ocupades)
                <button type="submit" name="aparcar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Aparcar</button>
            @endif
        
            @if($parking->plaçes_ocupades == 0)
                <button type="submit" name="desaparcar" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Desaparcar</button>
            @endif
        </form>
        
    </div>
</x-app-layout>