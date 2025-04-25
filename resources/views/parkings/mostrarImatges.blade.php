<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pujar Imatges') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold mb-4">Pujar Imatges del Pàrquing: {{ $parking->name }}</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('parkings.pujarImatges') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- ID del pàrquing -->
            <input type="hidden" name="parking_id" value="{{ $parking->id }}">

            <!-- Input imatge -->
            <div>
                <label for="imatge" class="block text-sm font-medium">Selecciona una imatge:</label>
                <input type="file" name="imatge" id="imatge" required
                       class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            </div>

            <!-- Botó -->
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Pujar Imatge
            </button>
        </form>

        <!-- Mostrar les imatges existents -->
        <h2 class="mt-10 text-xl font-semibold">Imatges pujades</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
            @foreach($imatges as $imatge)
                <div>
                    <img src="{{ asset('storage/' . $imatge->path) }}" alt="Imatge" class="rounded shadow">
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
