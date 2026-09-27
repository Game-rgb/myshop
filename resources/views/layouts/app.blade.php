<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold tracking-tight text-slate-900">Create your account</h2>
        <p class="mt-1 text-sm text-slate-500">Start shopping in less than a minute.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-slate-700 mb-1.5">
                Name
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}"
                   required autofocus autocomplete="name"
                   placeholder="Your full name"
                   class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm
                          text-slate-900 placeholder-slate-400
                          focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                          transition-all @error('name') border-red-400 @enderror">
            @error('name')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
                Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                   required autocomplete="username"
                   placeholder="you@example.com"
                   class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm
                          text-slate-900 placeholder-slate-400
                          focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                          transition-all @error('email') border-red-400 @enderror">
            @error('email')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                Password
            </label>
            <input id="password" type="password" name="password"
                   required autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm
                          text-slate-900 placeholder-slate-400
                          focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                          transition-all @error('password') border-red-400 @enderror">
            @error('password')
                <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 mb-1.5">
                Confirm Password
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   required autocomplete="new-password"
                   placeholder="••••••••"
                   class="w-full rounded-xl border-slate-200 bg-slate-50/50 px-4 py-2.5 text-sm
                          text-slate-900 placeholder-slate-400
                          focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20
                          transition-all">
        </div>

        <!-- Submit -->
        <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2
                       px-5 py-2.5 rounded-xl text-sm font-semibold text-white
                       bg-gradient-to-r from-blue-600 to-indigo-600
                       hover:from-blue-700 hover:to-indigo-700
                       shadow-sm hover:shadow-md transition-all">
            Create account
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </button>
    </form>

    <!-- Login link -->
    <p class="mt-6 text-center text-sm text-slate-500">
        Already have an account?
        <a href="{{ route('login') }}"
           class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
            Sign in
        </a>
    </p>
</x-guest-layout>