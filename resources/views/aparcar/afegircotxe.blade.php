<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Afegir Cotxe
        </h2>
    </x-slot>


        <div style="margin: 1%" class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 style="text-align:center" class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Afegeix les deades del teu cotxe:
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="post" action="/aparcar/cotxes/afegir">
                        @csrf
                        <br>

                        <div>
                            <label style="text-align:center" for="matricula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Matricula:</label>
                            <input type="text" name="matricula" id="matricula" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="" required="">
                        </div>
                        <br>

                        <div>
                            <label style="text-align:center" for="marca_cotxe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca del Cotxe:</label>
                            <input type="text" name="marca_cotxe" id="marca_cotxe" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <br>

                        <div>
                            <label style="text-align:center" for="model_cotxe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model:</label>
                            <input type="text" name="model_cotxe" id="model_cotxe" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <br>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Enviar</button>
                    </form>
                </div>
            </div>
        </div>

</x-app-layout>