{{-- Traduit --}}
<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            {{ app()->getLocale()}}
            <ul class="font-medium flex flex-col p-2 md:p-0 mt-2 border border-gray-100 rounded-lg bg-gray-100 md:flex-row md:space-x-4 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 justify-end">
                <li>
                    <button id="en" href="{{ url('en') }}" class="language-button block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent text-xs">EN</button>
                </li>
                <li>
                    <button id="es" href="{{ url('es') }}" class="language-button block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent text-xs">ES</button>
                </li>
                <li>
                    <button id="ca" href="{{ url('ca') }}" class="language-button block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent text-xs">CA</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
 
 <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>

                    <x-nav-link :href="route('users.index')" :active="Str::startsWith(request()->route()->getName(), ['users.', 'manage.'])">
                        {{ __('Manage Users') }}
                    </x-nav-link>

                    @can('dashboard.validate.users')
                    <x-nav-link :href="route('pending.users')" :active="Str::startsWith(request()->route()->getName(), ['pending.', 'denied.'])">
                        {{ __('Validate Users') }}
                    </x-nav-link>
                    @endcan

                    @can('dashboard.manage.users')
                    <x-nav-link :href="route('ban.users')" :active="Str::startsWith(request()->route()->getName(), ['ban.', 'manage.'])">
                        {{ __('Ban Users') }}
                    </x-nav-link>
                    @endcan

                    @can('dashboard.verify.users')
                    <x-nav-link :href="route('verify.users')" :active="Str::startsWith(request()->route()->getName(), ['verify.'])">
                        {{ __('Verify Users') }} {{ __('Verify Users') }}
                    </x-nav-link>
                    @endcan

                    @can('dashboard.roles')
                        <x-nav-link :href="route('roles.users')" :active="Str::startsWith(request()->route()->getName(), ['role.', 'roles.'])">
                            {{ __('Roles Users') }}
                        </x-nav-link>
                    @endcan
                </div>
                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
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
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
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
                {{ __('Home') }}
            </x-responsive-nav-link>

            @can('dashboard.validate.users')
            <x-responsive-nav-link :href="route('pending.users')" :active="Str::startsWith(request()->route()->getName(), ['pending.', 'denied.'])">
                {{ __('Validate Users') }}
            </x-responsive-nav-link>
            @endcan

            @can('dashboard.manage.users')
            <x-responsive-nav-link :href="route('ban.users')" :active="Str::startsWith(request()->route()->getName(), ['ban.', 'manage.'])">
                {{ __('Manage Users') }}
            </x-responsive-nav-link>
            @endcan

            @can('dashboard.verify.users')
            <x-responsive-nav-link :href="route('verify.users')" :active="Str::startsWith(request()->route()->getName(), ['verify.'])">
                {{ __('Verify Users') }}
            </x-responsive-nav-link>
            @endcan

            @can('dashboard.roles')
                <x-responsive-nav-link :href="route('roles.users')" :active="Str::startsWith(request()->route()->getName(), ['role.', 'roles.'])">
                    {{ __('Roles Users') }}
                </x-responsive-nav-link>
            @endcan
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
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
<script>
    document.querySelectorAll('.language-button').forEach(button => {
        button.addEventListener('click', () => {
            // Remove selected class from other buttons
            document.querySelectorAll('.language-button').forEach(otherButton => {
                otherButton.classList.remove('selected');
            });
            // Add selected class to clicked button
            button.classList.add('selected');
        });
    });
</script>