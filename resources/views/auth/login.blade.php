<x-auth-layout>
    <x-slot name="title">
        @lang('Login')
    </x-slot>

    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />


        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="title text-center">
            <h1>Masuk</h1>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="username" :value="__('Username')" />

                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required
                    autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-center mt-4 text-center">
                <x-button class="ml-3 btn-login text-bold">
                    {{ __('Masuk') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-auth-layout>

<style type="text/css">
    .title {
        font-weight: bold;
        font-size: 2.5rem;
    }

    .min-h-screen {
        background-image: url('{{ asset('img/bg_login.jpg') }}');
        min-height: 100vh;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .btn-login {
        background-color: rgb(185 28 28);
        font-weight: bold;
        width: 150px !important;
        text-align: center;
        margin-top: 10px;
    }
</style>
