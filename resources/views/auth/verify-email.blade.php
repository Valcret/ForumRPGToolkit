@extends('layouts.app')

@section('content')
    <div class="bodyconnect">
        <div class="connectiontxt">
            <img src="{{ asset('images/Trieur_rpg.png') }}" alt="Toolki">
            <p>Vérifie ton mail pour activer ton compte !</p>

            @if (session('status') == 'verification-link-sent')
                <div class="error-message" style="color: green;">
                    Un nouveau lien de vérification a été envoyé.
                </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="loginAndRegister">
                @csrf
                <button type="submit" class="buttonformtype">Renvoyer l'email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="buttonformtype">Se déconnecter</button>
            </form>
        </div>
    </div>
@endsection
