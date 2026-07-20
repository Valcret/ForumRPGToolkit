{{-- resources/views/legal/mentions.blade.php --}}
@extends('layouts.app')

@section('title', 'Mentions légales — RPG Toolkit')

@section('content')
    <div class="bodyconnect">
        <div class="connectiontxt">
            <img src="{{ asset('images/Toolkit_rpg.png') }}" alt="RPG Toolkit">
            <h1>Les mentions trop légales !</h1>

            <div class="pagebasique">
                <p>Conformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575
                    du 21 juin 2004 pour la Confiance dans l'économie numérique, dite L.C.E.N.,
                    il est porté à la connaissance des utilisateurs et visiteurs, ci-après
                    l'"Utilisateur", du site <strong>forumrpgtoolkit.fr</strong>,
                    ci-après le "Site", les présentes mentions légales.</p>

                {{-- Éditeur --}}
                <h2>1. Éditeur du site</h2>
                <p>
                    Le site <strong>forumrpgtoolkit.fr</strong> est édité par un particulier :<br>
                    Nom / Pseudo : <strong>[À COMPLÉTER]</strong><br>
                    Adresse e-mail de contact : <strong>[À COMPLÉTER]</strong>
                </p>

                {{-- Hébergement --}}
                <h2>2. Hébergement</h2>
                <p>
                    Le site est hébergé par la société <strong>o2switch</strong><br>
                    Siège social : 222-224 Boulevard Gustave Flaubert, 63000 Clermont-Ferrand, France<br>
                    Site web : <a href="https://www.o2switch.fr" target="_blank">www.o2switch.fr</a><br>
                    Téléphone : 04 44 44 60 40
                </p>

                {{-- Propriété intellectuelle --}}
                <h2>3. Propriété intellectuelle</h2>
                <p>
                    L'ensemble des contenus présents sur le site <strong>forumrpgtoolkit.fr</strong>
                    (textes, images, graphismes, logo, icônes...) est la propriété exclusive de
                    l'éditeur, sauf mentions contraires. Toute reproduction, distribution,
                    modification ou utilisation de ces contenus sans autorisation expresse est interdite.
                </p>

                {{-- Données personnelles --}}
                <h2>4. Données personnelles & RGPD</h2>
                <p>
                    Conformément au Règlement Général sur la Protection des Données (RGPD) —
                    Règlement UE 2016/679 — et à la loi Informatique et Libertés du 6 janvier
                    1978 modifiée, vous disposez des droits suivants concernant vos données
                    personnelles :
                </p>
                <ul>
                    <li>Droit d'accès</li>
                    <li>Droit de rectification</li>
                    <li>Droit à l'effacement ("droit à l'oubli")</li>
                    <li>Droit à la limitation du traitement</li>
                    <li>Droit à la portabilité</li>
                    <li>Droit d'opposition</li>
                </ul>
                <p>
                    Pour exercer ces droits, vous pouvez contacter l'éditeur à l'adresse :
                    <strong>[À COMPLÉTER]</strong>
                </p>
                <p>
                    Les données collectées (adresse e-mail, pseudo) sont utilisées uniquement
                    dans le cadre du fonctionnement du site et ne sont pas transmises à des tiers.
                </p>

                {{-- Cookies --}}
                <h2>5. Cookies</h2>
                <p>
                    Le site utilise des cookies techniques nécessaires à son fonctionnement
                    (session, authentification). Aucun cookie publicitaire ou de tracking
                    tiers n'est utilisé.
                </p>

                {{-- Responsabilité --}}
                <h2>6. Limitation de responsabilité</h2>
                <p>
                    L'éditeur s'efforce de maintenir le site accessible et à jour, mais ne peut
                    garantir l'exactitude, la complétude ou l'actualité des informations diffusées.
                    L'éditeur ne saurait être tenu responsable des dommages directs ou indirects
                    liés à l'utilisation du site.
                </p>

                {{-- Droit applicable --}}
                <h2>7. Droit applicable</h2>
                <p>
                    Les présentes mentions légales sont soumises au droit français.
                    En cas de litige, les tribunaux français seront seuls compétents.
                </p>

                <p><em>Dernière mise à jour : [À COMPLÉTER]</em></p>
            </div>
        </div>
    </div>
@endsection
