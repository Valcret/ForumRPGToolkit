@extends('layouts.app')

@section('content')
    <div class="bodyconnect">
        <div class="menu">
            <a class="menuconnect" href="{{ route('home') }}" title="Go accueil">
                <img src="{{ asset('images/Toolkit_rpg.png') }}" alt="Accueil">
            </a>
            <a class="menuconnect" href="{{ route('faceclaim.index') }}" title="Go Faceclaim">
                <img src="{{ asset('images/Facelaime_rpg.png') }}" alt="Faceclaim">
            </a>
            <a class="menuconnect" href="{{ route('fichcraft.index') }}" title="Go Fich'Craft">
                <img src="{{ asset('images/fich_craft_rpg.png') }}" alt="Fich'Craft">
            </a>
            <a class="menuconnect" href="{{ route('trieur.index') }}" title="Go Trieur">
                <img src="{{ asset('images/Trieur_rpg.png') }}" alt="Trieur">
            </a>
        </div>

        <div class="connectiontxt">
            <img src="{{ asset('images/Trieur_rpg.png') }}" alt="RPG Toolkit">
            <p>Coucou toi, tu reviens jouer avec moi ?</p>

            <form method="POST" action="{{ route('login') }}" class="loginAndRegister">
                @csrf

                <div class="formreggrpe">
                    <label for="email">Ton mail :</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email') }}"
                           required
                           placeholder="Entre ton email">
                    @error('email')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="formreggrpe">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password"
                           required
                           placeholder="Entre ton mot de passe">
                    @error('password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="formreggrpe forgotmp">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">J'ai oublié mon mot de passe</a>
                    @endif
                </div>

                <button type="submit" class="buttonformtype">Se connecter</button>
            </form>

            <p>Pas encore inscrit ? <a href="{{ route('register') }}">Rejoins-nous !</a></p>
        </div>
    </div>
@endsection
