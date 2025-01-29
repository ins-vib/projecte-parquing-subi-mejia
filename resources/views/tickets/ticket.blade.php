<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ticket d'Estacionament
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="text-center">
                    <h1 class="text-2xl font-bold mb-4">Resum d'Estacionament</h1>
                    <div class="mb-4">
                        <p>Matrícula: {{ $plaça->cotxe->matricula }}</p>
                        <p>Plaça: {{ $plaça->numero }}</p>
                        <p>Entrada: {{ $horaInici }}</p>
                        <p>Sortida: {{ $horaFinal }}</p>
                    </div>
                    <hr>
                    <div class="pt-4">
                        <p class="text-lg">Temps estacionat: {{ number_format($horesAparcat, 2) }} hores</p>
                        <p class="text-lg">Preu per hora: {{ number_format($plaça->zona->parking->tarifa->preu, 2) }}€</p>
                        <p class="text-xl font-bold mt-2">Import total: {{ number_format($preuTotal, 2) }}€</p>
                    </div>
                    <div class="mt-6">
                        <button onclick="window.print()" class="bg-blue-500 text-white px-4 py-2 rounded">
                            Imprimir Ticket
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
