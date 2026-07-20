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
            <img src="{{ asset('images/Trieur_rpg.png') }}" alt="Toolki">
            <p>Coucou toi, alors, prêt à nous rejoindre ?</p>

            <form method="POST" action="{{ route('register') }}" class="loginAndRegister">
                @csrf

                <div class="formreggrpe">
                    <label for="name">Ton pseudo :</label>
                    <input type="text" id="name" name="name"
                           value="{{ old('name') }}"
                           required
                           placeholder="Entre ton pseudo">
                    @error('name')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

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

                <div class="formreggrpe">
                    <label for="password_confirmation">Répéter le mot de passe :</label>
                    <input type="password" id="password_confirmation"
                           name="password_confirmation"
                           required
                           placeholder="Confirme ton mot de passe">
                </div>

                <div class="formreggrpe consent">
                    <input type="checkbox" id="consent" name="consent" required>
                    <label for="consent">
                        J'accepte que mes informations personnelles soient utilisées uniquement pour le RPG TOOLKIT.
                    </label>
                </div>

                <button type="submit" class="buttonformtype">S'enregistrer</button>
            </form>

            <p>Déjà inscrit ? <a href="{{ route('login') }}">Connecte-toi !</a></p>
        </div>
    </div>
@endsection
