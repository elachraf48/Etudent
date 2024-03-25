<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<x-guest-layout>

    @if (session('status'))
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ session('status') }}
    </div>
    @endif
    <x-slot name="logo">
        <!-- <x-authentication-card-logo /> -->
    </x-slot>

    <main>
        <section class="form">
            <div class="logo">
                <img id="banner" src="./img/banner.png" alt="logo">
            </div>
            <h1 class="form__title">Connectez-vous à votre compte</h1>
            <p class="form__description">Bienvenue de retour ! S'il vous plaît, entrez vos informations.</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <label class="form-control__label">E-mail</label>
                <input type="email" id="email" class="form-control" name="email" :value="old('email')" required autofocus autocomplete="username">

                <label class="form-control__label">Mot de passe</label>
                <div class="password-field">
                    <input type="password" class="form-control" minlength="4" id="password" name="password" required autocomplete="current-password">
                    <svg id="togglePassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </div>

                <div class="password__settings">
                    <label class="password__settings__remember">
                        <input type="checkbox" id="remember_me" name="remember">
                        <span class="custom__checkbox">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </span>
                        Souviens-toi de moi
                    </label>

                </div>
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif
                <button type="submit" class="form__submit" id="submit">Se connecter</button>

            </form>
            <x-validation-errors class="mb-4" />

        <span class="bg-secondary" style="position: fixed; bottom: 0; left: 18vw; "><a style="text-decoration: none" target="_blank" href="http://cv.achraf48.co"> Réaliser et Développé par Achraf-Elabouye</a> </span>

        </section>
        <div id="back">
            <canvas id="canvas" class="canvas-back"></canvas>
            <div class="backRight">
            </div>
            <div class="backLeft">
            </div>
        </div>


    </main>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paper.js/0.11.3/paper-full.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</x-guest-layout>