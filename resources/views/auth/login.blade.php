<x-guest-layout>

    <div class="min-h-[480px] max-w-3xl mx-auto grid grid-cols-2 rounded-xl overflow-hidden shadow-sm">

        <!-- LEFT: Brand panel -->
        <div class="bg-gray-900 text-white p-10 flex flex-col justify-between">
            <p class="text-lg font-medium">MyShop</p>

            <div>
                <p class="text-xl font-medium leading-snug mb-2">
                    Everything you need, in one cart.
                </p>
                <p class="text-sm text-gray-400">
                    Browse categories, track orders, and check out in seconds.
                </p>
            </div>

            <div class="flex gap-1.5">
            </div>
        </div>

        <!-- RIGHT: Login form -->
        <div class="bg-white p-10 flex flex-col justify-center">

            <h1 class="text-xl font-medium mb-1">Welcome back</h1>
            <p class="text-sm text-gray-500 mb-6">Log in to continue to your account</p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-sm text-gray-500" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-sm text-gray-500" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <label for="remember_me" class="inline-flex items-center gap-2">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300" name="remember">
                        <span class="text-sm text-gray-500">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-blue-600" href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full mt-6 bg-gray-900 text-white py-2.5 rounded-md text-sm hover:bg-gray-800">
                    {{ __('Log in') }}
                </button>

                <p class="text-sm text-gray-500 text-center mt-4">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-blue-600">Register</a>
                </p>
            </form>
        </div>

    </div>

</x-guest-layout>