<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-red-400" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input id="email" 
                class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-red-500 focus:ring-red-500 rounded-md" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input id="password" 
                class="block mt-1 w-full bg-gray-700 border-gray-600 text-white focus:border-red-500 focus:ring-red-500 rounded-md"
                type="password"
                name="password"
                required 
                autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" 
                    class="rounded border-gray-600 bg-gray-700 text-red-600 shadow-sm focus:ring-red-500" 
                    name="remember">
                <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-red-400 hover:text-red-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="ms-3 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md transition duration-200">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>