<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('posts.index') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                    @if (Auth::user()->is_admin)
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index ')"> 
                                Admin
                            </x-nav-link>
                        </div>
                    @endif
                @endauth
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"> 
                        {{ __('translate.navbar.dashboard') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-5 sm:flex">
                    <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                        {{ __('translate.navbar.add') }}
                    </x-nav-link>
                </div>
            </div>
            <!-- Settings Dropdown -->
            
            <div class="hidden sm:flex sm:items-center sm:ml-6">
             
                @auth
                <x-dropdown align="right" width="48">

                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    

                    <x-slot name="content">
                        
                        @if (preg_match("([0-9]+)", Request::path(), $matches))
                            @foreach(config('app.available_locales') as $locale)
                                <x-nav-link :href="route(Route::currentRouteName(), ['locale' => $locale,'post' => $matches[0]])" :active="app()->getLocale() == $locale">
                                    {{ strtoupper($locale) }}
                                </x-nav-link>
                            @endforeach
                            
                        @else
                            @foreach(config('app.available_locales') as $locale)
                                <x-nav-link :href="route(Route::currentRouteName(), ['locale' => $locale])" :active="app()->getLocale() == $locale">
                                    {{ strtoupper($locale) }}
                                </x-nav-link>
                            @endforeach
                        @endif
               
                        <!-- Authentication -->    
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('translate.navbar.logout') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth

                @guest
                <x-dropdown align="right" width="48">
                   
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>Menu</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    

                    <x-slot name="content">
                        @foreach(config('app.available_locales') as $locale)
                            <x-nav-link :href="route(\Illuminate\Support\Facades\Route::currentRouteName(), ['locale' => $locale])" :active="app()->getLocale() == $locale">
                                {{ strtoupper($locale) }}
                            </x-nav-link>
                        @endforeach
                    <!-- Authentication -->
                        <x-dropdown-link :href="route('login')">
                            {{ __('translate.navbar.login') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('register')">
                            {{ __('translate.navbar.register') }}
                        </x-dropdown-link>
                    </x-slot>
                </x-dropdown>
                @endguest
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
        @if (preg_match("([0-9]+)", Request::path(), $matches))
            @foreach(config('app.available_locales') as $locale)
                <x-nav-link :href="route(Route::currentRouteName(), ['locale' => $locale,'post' => $matches[0]])" :active="app()->getLocale() == $locale">
                    {{ strtoupper($locale) }}
                </x-nav-link>
            @endforeach     
        @else
            @foreach(config('app.available_locales') as $locale)
                <x-nav-link :href="route(Route::currentRouteName(), ['locale' => $locale])" :active="app()->getLocale() == $locale">
                    {{ strtoupper($locale) }}
                </x-nav-link>
            @endforeach
        @endif
        @guest
        <div class="pt-2 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('login')">
                {{ __('translate.navbar.login') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('register')">
                {{ __('translate.navbar.register') }}
            </x-responsive-nav-link>
        </div>
        @endguest
        @auth
            @if (Auth::user()->is_admin)
                <div class="pt-2 pb-2 space-y-1">
                    <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.index ')"> 
                        Admin
                    </x-responsive-nav-link>
                </div>
            @endif
        @endauth
        <div class="pt-2 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('translate.navbar.dashboard') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-2 space-y-1">
            <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                {{ __('translate.navbar.add') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
       
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200">

            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
        
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('translate.navbar.logout') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth
    </div>
</nav>
