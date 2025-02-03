<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Llistat de Pàrquings
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow">
        @foreach ($data as $parking)
            <div class="p-4 border-b flex justify-between items-center">
                <div>
                    @if ($parking->is_open)
                        <span class="text-green-500">✅</span>
                        <span class="font-semibold">{{ $parking->name }}</span> - <span class="text-green-600">Obert</span>
                        @if ($parking->has_free_spaces)
                            | <span class="text-blue-600">Places disponibles</span>
                        @else
                            | <span class="text-red-600">Plé</span>
                        @endif
                    @else
                        <span class="text-red-500">❌</span>
                        <span class="font-semibold">{{ $parking->name }}</span> - <span class="text-red-600">Tancat</span>
                    @endif
                </div>
                
                @if ($parking->is_open && $parking->has_free_spaces)
                    <button onclick="toggleAddress({{ $parking->id }})" class="bg-blue-500 text-white px-3 py-1 rounded">
                        Veure Adreça
                    </button>
                @endif
            </div>
            <div id="address-{{ $parking->id }}" class="hidden p-3 bg-gray-100 text-gray-700 rounded">
                📍 {{ $parking->address }}
            </div>
        @endforeach
    </div>

    <script>
        function toggleAddress(parkingId) {
            document.getElementById('address-' + parkingId).classList.toggle('hidden');
        }
    </script>
</x-app-layout>
