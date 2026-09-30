<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight text-slate-900">Create account</h1>
        <p class="mt-2 text-slate-500">Start shopping in less than a minute.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-2">
                Full name
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   required autofocus autocomplete="name"
                   placeholder="John Doe"
                   class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm
                          text-slate-900 placeholder-slate-400 shadow-sm hover:border-slate-300
                          focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10
                          transition-all duration-200
                          @error('name') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('name')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-2">
                Email address
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autocomplete="username"
                   placeholder="you@example.com"
                   class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm
                          text-slate-900 placeholder-slate-400 shadow-sm hover:border-slate-300
                          focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10
                          transition-all duration-200
                          @error('email') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-2">
                Password
            </label>
            <input id="password" type="password" name="password"
                   required autocomplete="new-password"
                   placeholder="At least 8 characters"
                   class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm
                          text-slate-900 placeholder-slate-400 shadow-sm hover:border-slate-300
                          focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10
                          transition-all duration-200
                          @error('password') border-red-400 focus:border-red-500 focus:ring-red-500/10 @enderror">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-2">
                Confirm password
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required autocomplete="new-password"
                   placeholder="Repeat your password"
                   class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm
                          text-slate-900 placeholder-slate-400 shadow-sm hover:border-slate-300
                          focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10
                          transition-all duration-200">
        </div>

        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2
                       px-5 py-3 rounded-xl text-sm font-semibold text-white
                       bg-gradient-to-r from-blue-600 to-indigo-600
                       hover:from-blue-700 hover:to-indigo-700
                       shadow-lg shadow-blue-600/20 hover:shadow-xl hover:shadow-blue-600/30
                       active:scale-[0.98]
                       transition-all duration-200">
            Create account
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </button>
    </form>

    <p class="mt-8 text-center text-sm text-slate-500">
        Already have an account?
        <a href="{{ route('login') }}"
           class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
            Log in
        </a>
    </p>
</x-guest-layout>