{{-- resources/views/trieur/partials/accueil.blade.php --}}

<section id="accueil" class="content-section">
    <div class="container-fluid">
        <div class="homesectiontrieur">

            <div class="trieurintrotop">
                <img class="trieurtoolki" src="{{ asset('images/Trieur_rpg.png') }}" />
                <div>
                    <h1>Tu te souviens ? Je suis Toolki !</h1>
                    <p>Ici tu trouveras tout ce qui va te permettre <br/>
                        de <em>gérer tes rps, tes forums et tes personnages !</em></p>
                </div>
            </div>

            @guest
                <div class="invitetrieurzone1">
                    <div class="inviteenregistre">
                        Quoi, tu n'as pas encore de compte ?
                        <a href="{{ route('register') }}"><i class="bi bi-person-up"></i></a>
                        <i>Enregistre-toi</i>
                    </div>
                    <div class="inviteconnect">
                        Ah ! Tu n'es juste pas connecté ?
                        <a href="{{ route('login') }}"><i class="bi bi-door-open"></i></a>
                        <i>Connecte-toi</i>
                    </div>
                </div>
            @endguest

            @auth
                <div class="connectetrieur1">
                    <div class="gererrp">
                        Tu veux ajouter un RP/perso/fofo ?
                        <a href="#ajouter" data-target-section="ajouter">
                            <i class="bi bi-bookmark-plus"></i>
                        </a>
                    </div>
                    <div class="gererrp">
                        Tu veux gérer tes rps ?
                        <a href="#roleplays" data-target-section="roleplays">
                            <i class="bi bi-list-check"></i>
                        </a>
                    </div>
                    <div class="gererrp">
                        Tu veux gérer tes persos ?
                        <a href="#personnages" data-target-section="personnages">
                            <i class="bi bi-person-lines-fill"></i>
                        </a>
                    </div>
                    <div class="gererrp">
                        Tu veux gérer tes forums ?
                        <a href="#forums" data-target-section="forums">
                            <i class="bi bi-pc-display-horizontal"></i>
                        </a>
                    </div>
                    <div class="gererrp">
                        T'es en galère ?
                        <a href="#faq" data-target-section="faq">
                            <i class="bi bi-question-circle"></i>
                        </a>
                    </div>
                </div>
            @endauth

        </div>
    </div>
</section>
