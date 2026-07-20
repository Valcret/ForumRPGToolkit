@extends('layouts.app')

@section('content')
    <div class="bodyconnect">
        <div class="connectiontxt">
            <img src="{{ asset('images/Trieur_rpg.png') }}" alt="Toolki">
            <p>Confirme ton mot de passe pour continuer.</p>

            <form method="POST" action="{{ route('password.confirm') }}" class="loginAndRegister">
                @csrf
                <div class="formreggrpe">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password"
                           required
                           placeholder="Entre ton mot de passe">
                    @error('password')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="buttonformtype">Confirmer</button>
            </form>
        </div>
    </div>
@endsection
