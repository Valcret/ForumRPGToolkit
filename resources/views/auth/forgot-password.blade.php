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
            <p>On retrouve ton mot de passe ensemble !</p>

            @if (session('status'))
                <div class="error-message" style="color: green;">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="loginAndRegister">
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
                <button type="submit" class="buttonformtype">Envoyer le lien</button>
            </form>
        </div>
    </div>
@endsection
