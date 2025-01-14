<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <svg height='50px' width='50px' version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#E6E6E6;" d="M464.058,9.291H47.944c-21.348,0-38.653,17.305-38.653,38.653v416.113 c0,21.348,17.305,38.653,38.653,38.653h416.113c21.348,0,38.653-17.305,38.653-38.653V47.944 C502.711,26.596,485.405,9.291,464.058,9.291z"></path> <rect x="60.632" y="60.629" style="fill:#47A7DD;" width="390.742" height="390.754"></rect> <g> <polygon style="fill:#6AC7EF;" points="369.548,60.629 118.889,451.378 60.632,451.378 60.632,371.071 259.774,60.629 "></polygon> <polygon style="fill:#6AC7EF;" points="451.369,60.629 451.369,110.774 232.873,451.378 175.682,451.378 426.341,60.629 "></polygon> </g> <path style="fill:#E6E6E6;" d="M263.758,110.328h-15.062h-15.748h-48.819v291.345h64.568v-83.669h15.062 c57.348,0,103.838-46.489,103.838-103.838l0,0C367.595,156.817,321.106,110.328,263.758,110.328z M307.752,214.165 c0,26.036-21.107,47.143-47.143,47.143h-11.913v-94.287h11.913C286.645,167.022,307.752,188.129,307.752,214.165L307.752,214.165z"></path> <path d="M462.662,0H49.339C22.133,0,0,22.133,0,49.339v328.305c0,5.131,4.159,9.291,9.291,9.291s9.291-4.16,9.291-9.291V49.339 c0-16.96,13.799-30.757,30.757-30.757h413.323c16.959,0,30.757,13.797,30.757,30.757v413.323c0,16.96-13.799,30.757-30.757,30.757 H49.339c-16.959,0-30.757-13.797-30.757-30.757v-52.932c0-5.131-4.159-9.291-9.291-9.291S0,404.598,0,409.729v52.932 C0,489.867,22.133,512,49.339,512h413.323C489.867,512,512,489.867,512,462.661V49.339C512,22.133,489.867,0,462.662,0z"></path> <path d="M352.26,51.338H60.629c-5.132,0-9.291,4.16-9.291,9.291v390.743c0,5.131,4.159,9.291,9.291,9.291h390.743 c5.132,0,9.291-4.16,9.291-9.291V60.629c0-5.131-4.159-9.291-9.291-9.291h-67.024c-5.132,0-9.291,4.16-9.291,9.291 s4.159,9.291,9.291,9.291h57.734v372.161H69.919V69.919h282.34c5.132,0,9.291-4.16,9.291-9.291S357.392,51.338,352.26,51.338z"></path> <path d="M184.128,340.116c-5.132,0-9.291,4.16-9.291,9.291v52.266c0,5.131,4.159,9.291,9.291,9.291h64.568 c5.132,0,9.291-4.16,9.291-9.291v-74.379h5.771c62.379,0,113.128-50.749,113.128-113.128s-50.749-113.128-113.128-113.128h-79.63 c-5.132,0-9.291,4.16-9.291,9.291V317.32c0,5.131,4.159,9.291,9.291,9.291c5.132,0,9.291-4.16,9.291-9.291V119.618h70.339 c52.133,0,94.547,42.414,94.547,94.547s-42.414,94.547-94.547,94.547h-15.062c-5.132,0-9.291,4.16-9.291,9.291v74.379h-45.986 v-42.975C193.419,344.276,189.259,340.116,184.128,340.116z"></path> <path d="M248.696,270.599h11.912c31.118,0,56.435-25.316,56.435-56.434s-25.318-56.434-56.435-56.434h-11.912 c-5.132,0-9.291,4.16-9.291,9.291v94.287C239.405,266.44,243.564,270.599,248.696,270.599z M257.986,176.313h2.621 c20.873,0,37.854,16.981,37.854,37.853s-16.981,37.853-37.854,37.853h-2.621V176.313z"></path> </g></svg>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if(Auth::user()->isAdmin)
                    <x-nav-link :href="route('parkings.llista')" :active="request()->routeIs('parkings.llista')">
                        {{ __('Parkings') }}
                    </x-nav-link>

                    <x-nav-link :href="route('zona.llista')" :active="request()->routeIs('zona.llista')">
                        {{ __('Plantes') }}
                    </x-nav-link>

                    <x-nav-link :href="route('plaza.llista')" :active="request()->routeIs('plaza.llista')">
                        {{ __('Plaçes') }}
                    </x-nav-link>
                    @endif

                    @if(Auth::user()->isNormal)
                    <x-nav-link :href="route('cotxes.llista')" :active="request()->routeIs('cotxes.llista')">
                        {{ __('Cotxes') }}
                    </x-nav-link>
                    
                    <x-nav-link :href="route('aparcar.aparcar')" :active="request()->routeIs('aparcar.aparcar')">
                        {{ __('Aparcar') }}
                    </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
