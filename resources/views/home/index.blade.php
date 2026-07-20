@extends('layouts.home')

@section('content')
    <div class="bodyarrived">

        <div class="accueilnav">
            <a class="homemenu" href="{{ route('faceclaim.index') }}"><img src="{{ asset('images/Facelaime_rpg.png') }}"></a>
            <a class="homemenu" href="{{ route('fichcraft.index') }}"><img src="{{ asset('images/fich_craft_rpg.png') }}"></a>
            <a class="homemenu" href="{{ route('trieur.index') }}"><img src="{{ asset('images/Trieur_rpg.png') }}"></a>
        </div>

        <div class="home">
            <img src="{{ asset('images/Toolkit_rpg.png') }}">
            <p>Bienvenue, je suis <em>Toolki</em>, et tu es désormais sur FORUM RPG TOOLKIT. <br>Ici, tu trouveras tous les éléments nécessaires pour tes RPG !</p>
            <p>Besoin d'avoir un trieur à RP intuitif et qui te permettra de ranger rapidement ta liste <i>interminable</i> de rp ? <br>Alors tu devrais cliquer sur <em>Trieur RP</em></p>
            <p>Au contraire, tu es une quiche en code et tu n'as pas envie de te casser la tête? Le <em>Fich'craft</em> est fait pour toi. <br>Si tu es sur un forum partenaire de notre petit monde, alors tu trouveras une fiche à remplir pour créer ton personnage!</p>
            <p>Rien de tout cela ne t'intéresse, tu cherches un avatar ? <br>Le <em>Facelaim</em> est là pour toi ! </p>
        </div>

    </div>
@endsection
