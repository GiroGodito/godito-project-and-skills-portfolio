@auth
<nav x-data="{ open: false }" class="bg-gray-900 border-b border-[#e3e3e0] dark:border-[#3E3E3A]">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#FF4433] transition">
                        Portfolio Manager
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[#1b1b18] dark:text-[#EDEDEC]">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#1b1b18] dark:text-[#EDEDEC] bg-transparent hover:text-[#f53003] dark:hover:text-[#FF4433] focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('dashboard')" class="text-[#1b1b18] dark:text-[#EDEDEC] hover:bg-[#f5f5f4] dark:hover:bg-[#2a2a28]">
                            {{ __('Dashboard') }}
                        </x-dropdown-link>

                        <!-- Authentication - Updated for Turbo (no page reload) -->
                        <a href="{{ route('logout') }}" 
                           data-turbo-method="post"
                           data-turbo-confirm="Are you sure you want to logout?"
                           class="block w-full px-4 py-2 text-sm leading-5 text-red-600 dark:text-red-400 hover:bg-[#f5f5f4] dark:hover:bg-[#2a2a28] focus:outline-none transition duration-150 ease-in-out text-left">
                            {{ __('Log Out') }}
                        </a>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Menu (Mobile) -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-[#1b1b18] dark:text-[#EDEDEC] hover:text-[#f53003] dark:hover:text-[#FF4433] hover:bg-[#f5f5f4] dark:hover:bg-[#2a2a28] focus:outline-none focus:bg-[#f5f5f4] dark:focus:bg-[#2a2a28] focus:text-[#f53003] dark:focus:text-[#FF4433] transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-[#1b1b18] dark:text-[#EDEDEC]">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-[#e3e3e0] dark:border-[#3E3E3A]">
            <div class="px-4">
                <div class="font-medium text-base text-[#1b1b18] dark:text-[#EDEDEC]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#706f6c] dark:text-[#A1A09A]">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('dashboard')" class="text-[#1b1b18] dark:text-[#EDEDEC]">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

                <!-- Authentication - Mobile version updated for Turbo (no page reload) -->
                <a href="{{ route('logout') }}" 
                   data-turbo-method="post"
                   data-turbo-confirm="Are you sure you want to logout?"
                   class="block w-full py-2 pl-3 pr-4 text-base font-medium text-red-600 dark:text-red-400 hover:bg-[#f5f5f4] dark:hover:bg-[#2a2a28] focus:outline-none transition duration-150 ease-in-out">
                    {{ __('Log Out') }}
                </a>
            </div>
        </div>
    </div>
</nav>
@endauth