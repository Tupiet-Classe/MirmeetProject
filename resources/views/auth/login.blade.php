<x-guest-layout>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form id="form-login" method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input tabindex="1" id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="flex justify-between">
                <x-input-label for="password" :value="__('Password')" />

                @if (Route::has('password.request'))
                    <a tabindex="5"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ml-2"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input tabindex="2" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        @if ($errors->has('g-recaptcha-response'))
            <span class="invalid-feedback text-sm text-red-600" role="alert">
                <p class="mt-1">{{ $errors->first('g-recaptcha-response') }}</p>
            </span>
        @endif

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('register'))
                <a tabindex="4"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('register') }}">
                    {{ __('Sign up for free') }}
                </a>
            @endif
            <div class="flex items-center justify-end">
                <x-login-button id="login-btn" tabindex="3" data-modal-target="loginModal"
                    data-modal-toggle="loginModal" class="ml-3">
                    {{ __('Log in') }}
                </x-login-button>
            </div>
        </div>

        @include('auth.login-modal')

        <div class="mt-4">
            <hr>
            <br>
            <p class="text-center text-gray-500">{{ __('Or enter with') }}</p>
            <div class="flex justify-center mt-4">
                <a tabindex="6" href="{{ route('login.google') }}"
                    class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded">
                    <i class="fab fa-google"></i> {{ __('Google') }}
                </a>
                <span class="mx-4 text-gray-400">{{ __('') }}</span>
                <a tabindex="7" href="{{ route('login.github') }}"
                    class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">
                    <i class="fab fa-github"></i> {{ __('Github') }}
                </a>
            </div>
        </div>
    </form>

    <script>
        $("#password").keyup(function(event) {
            if (event.keyCode === 13) {
                $("#login-btn").click();
            }
        });
    </script>

    @include('auth.submit-form')
    @include('auth.toast-error')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
</x-guest-layout>
