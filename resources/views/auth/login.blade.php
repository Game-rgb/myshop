<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">Welcome back</h1>
        <p class="mt-2 text-slate-500">Log in to continue to your account.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                Email address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autofocus autocomplete="username"
                   placeholder="you@example.com"
                   class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm
                          text-slate-900 placeholder-slate-400
                          shadow-sm hover:border-slate-300
                          focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10
                          transition-all duration-200
                          @error('email') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-sm font-semibold text-slate-700">
                    Password
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-xs font-medium text-blue-600 hover:text-blue-700 transition-colors">
                        Forgot?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password"
                   required autocomplete="current-password"
                   placeholder="••••••••"
                   class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm
                          text-slate-900 placeholder-slate-400
                          shadow-sm hover:border-slate-300
                          focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10
                          transition-all duration-200
                          @error('password') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
            <input id="remember_me" type="checkbox" name="remember"
                   class="rounded border-slate-300 text-blue-600 shadow-sm
                          focus:ring-2 focus:ring-blue-500 focus:ring-offset-0">
            <span class="ms-2 text-sm text-slate-600">Remember me for 30 days</span>
        </label>

        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2
                       px-5 py-3 rounded-xl text-sm font-semibold text-white
                       bg-gradient-to-r from-blue-600 to-indigo-600
                       hover:from-blue-700 hover:to-indigo-700
                       shadow-lg shadow-blue-600/20 hover:shadow-xl hover:shadow-blue-600/30
                       active:scale-[0.98]
                       transition-all duration-200">
            Log in
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </button>
    </form>

    <p class="mt-8 text-center text-sm text-slate-500">
        Don't have an account?
        <a href="{{ route('register') }}"
           class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
            Create one
        </a>
    </p>
</x-guest-layout>