@extends('layouts.app')

@section('content')
    <div class="bodyconnect">
        <div class="menu">
            <a class="menuconnect" href="{{ route('home') }}">
                <img src="{{ asset('images/Toolkit_rpg.png') }}" alt="Accueil">
            </a>
        </div>

        <div class="connectiontxt">
            <img src="{{ asset('images/Trieur_rpg.png') }}" alt="Toolki">
            <p>On repart sur de bonnes bases !</p>

            <form method="POST" action="{{ route('password.store') }}" class="loginAndRegister">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="formreggrpe">
                    <label for="email">Ton mail :</label>
                    <input type="email" id="email" name="email"
                           value="{{ old('email', $request->email) }}"
                           required
                           placeholder="Entre ton email">
                    @error('email')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="formreggrpe">
                    <label for="password">Nouveau mot de passe :</label>
                    <input type="password" id="password" name="password"
                           required
                           placeholder="Ton nouveau mot de passe">
                    @error('password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>

                <div class="formreggrpe">
                    <label for="password_confirmation">Confirmer :</label>
                    <input type="password" id="password_confirmation"
                           name="password_confirmation"
                           required
                           placeholder="Confirme ton nouveau mot de passe">
                </div>

                <button type="submit" class="buttonformtype">Réinitialiser</button>
            </form>
        </div>
    </div>
@endsection
