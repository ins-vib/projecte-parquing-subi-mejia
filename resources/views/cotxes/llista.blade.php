<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista Cotxes
        </h2>
    </x-slot>

    @foreach ($cotxes as $cotxe)
    {{$cotxe->matricula}} , {{$cotxe->marca_cotxe}}
    @endforeach
</x-app-layout>