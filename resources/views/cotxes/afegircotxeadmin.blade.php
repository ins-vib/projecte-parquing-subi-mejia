<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Afegir Cotxe
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


        <div style="margin: 1%" class="flex flex-col items-center justify-center px-6 py-8 mx-auto lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 style="text-align:center" class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Afegeix les dades del teu cotxe:
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="post" action="/cotxes/afegir/admin">
                        @csrf
                        @if ($errors->has('matricula'))
                            <div class="text-red-500 text-sm">
                                La matrícula ha de tenir 4 números seguits de 3 lletres majúscules
                            </div>
                        @endif
                        <br>

                        <div>
                            <label style="text-align:center" for="matricula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Matricula:</label>
                            <input type="text" name="matricula" id="matricula" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="{{ old('matricula') }}" required>
                        </div>
                        <div id="teclatVirtual" class="grid grid-cols-10 gap-1 text-center mt-2">
                        </div>
                        <br>

                        <div>
                            <label style="text-align:center" for="marca_cotxe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Marca del Cotxe:</label>
                            <input type="text" name="marca_cotxe" id="marca_cotxe" value="{{ old('marca_cotxe') }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <br>

                        <div>
                            <label style="text-align:center" for="model_cotxe" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model:</label>
                            <input type="text" name="model_cotxe" id="model_cotxe" value="{{ old('model_cotxe') }}" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <br>
                        <div>
                            <label style="text-align:center" for="tipus_vehicle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipus de vehicle</label>
                            <select name="tipus_vehicle" id="tipus_vehicle" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="cotxe" {{ old('tipus_vehicle') == 'cotxe' ? 'selected' : '' }}>Cotxe</option>
                                <option value="moto" {{ old('tipus_vehicle') == 'moto' ? 'selected' : '' }}>Moto</option>
                                <option value="other" {{ old('tipus_vehicle') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <div id="imatgeVehicle" class="mt-4 flex justify-center">
                            </div>
                        </div>
                        <br>
                        <div>
                            <label style="text-align:center" for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select User:</label>
                            
                            <div class="relative">
                                <input type="text" id="buscarUsuari" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 mb-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Cerca usuari per nom o email...">
                                
                                <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    <option value="">Usuari</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }} class="user-option">{{ $user->name }} - {{ $user->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Afegir</button>
                    </form>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const buscador = document.getElementById('buscarUsuari');
            const selectUsuari = document.getElementById('user_id');
            const opcionsUsuari = Array.from(selectUsuari.querySelectorAll('.user-option'));
            
            buscador.addEventListener('input', function() {
                const buscadorTerm = this.value.toLowerCase();
                const opcioSeleccionada = selectUsuari.value;
                while (selectUsuari.options.length > 1) {
                    selectUsuari.remove(1);
                }
                opcionsUsuari.forEach(option => {
                    const optionText = option.textContent.toLowerCase();
                    if (buscadorTerm === '' || optionText.includes(buscadorTerm)) {
                        const newOption = option.cloneNode(true);
                        selectUsuari.add(newOption);
                    }
                });
                if (opcioSeleccionada) {
                    for (let i = 0; i < selectUsuari.options.length; i++) {
                        if (selectUsuari.options[i].value === opcioSeleccionada) {
                            selectUsuari.selectedIndex = i;
                            break;
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
        const teclat = "1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        const teclatContenidor = document.getElementById("teclatVirtual");
        const inputMatricula = document.getElementById("matricula");
            teclat.split('').forEach(char => {
                const btn = document.createElement("button");
                btn.setAttribute("type", "button");
                btn.textContent = char;
                btn.className = "bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-3 rounded";
                btn.addEventListener("click", () => {
                    if (inputMatricula.value.length < 7) {
                        inputMatricula.value += char;
                    }
                });
                teclatContenidor.appendChild(btn);
            });
        const tipusSelect = document.getElementById('tipus_vehicle');
        const imatgeContainer = document.getElementById('imatgeVehicle');

        const imatges = {
            cotxe: '🚗',
            moto: '🏍️',
            other: '🚙'
        };
        function actualitzaImatge() {
            const valor = tipusSelect.value;
            const emoji = imatges[valor] || '❓';
            imatgeContainer.innerHTML = `
                <div class="text-6xl">${emoji}</div>
            `;
        }
        actualitzaImatge();
        tipusSelect.addEventListener('change', actualitzaImatge);
        });
    </script>
</x-app-layout>