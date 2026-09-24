<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 lg:px-10">
        <div class="flex justify-between h-20">
            <div class="flex items-center space-x-9">

                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-lg font-semibold text-gray-800">
                        MyShop
                    </a>
                </div>

                <div class="hidden sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-1 pt-1 text-[15px] font-medium border-b-2 {{ request()->routeIs('home') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Home
                    </a>

                    <a href="{{ route('products.index') }}"
                       class="inline-flex items-center px-1 pt-1 text-[15px] font-medium border-b-2 {{ request()->routeIs('products.index') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Products
                    </a>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('categories.index') }}"
                               class="inline-flex items-center px-1 pt-1 text-[15px] font-medium border-b-2 {{ request()->routeIs('categories.*') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Category
                            </a>
                        @endif
                    @endauth


                    <a href="{{ route('orders.index') }}"
                       class="inline-flex items-center px-1 pt-1 text-[15px] font-medium border-b-2 {{ request()->routeIs('orders.*') && !request()->routeIs('orders.admin') && !request()->routeIs('orders.charts') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        History
                    </a>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('orders.charts') }}"
                               class="inline-flex items-center px-1 pt-1 text-[15px] font-medium border-b-2 {{ request()->routeIs('orders.charts') ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                                Charts
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Right side: Cart + Avatar/Login -->
            <div class="hidden sm:flex sm:items-center sm:gap-6">
                @auth
                    <a href="{{ route('cart.index') }}" class="text-gray-500 text-xl">🛒</a>
                @endauth

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="w-9 h-9 rounded-full overflow-hidden">
                                @if (auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="w-full h-full object-cover">
                                @else
                                    <span class="w-9 h-9 rounded-full bg-indigo-100 text-indigo-700 font-medium text-sm flex items-center justify-center">
                                        {{ substr(auth()->user()->name, 0, 1) }}
                                    </span>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-blue-600">Login</a>
                    <a href="{{ route('register') }}" class="text-sm text-blue-600">Register</a>
                @endauth
            </div>

            <!-- Hamburger (mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
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
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Products') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('orders.index')" :active="request()->routeIs('orders.index')">
                {{ __('History') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                {{ __('Cart') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ auth()->user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-1 border-t border-gray-200 px-4 space-y-1">
                <x-responsive-nav-link :href="route('login')">{{ __('Login') }}</x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')">{{ __('Register') }}</x-responsive-nav-link>
            </div>
        @endauth
    </div>

</nav>