@extends('layouts.app')

@section('title', 'Contact — RPG Toolkit')

@section('content')
    <div class="bodyconnect">
        <div class="connectiontxt">
            <img src="{{ asset('images/Toolkit_rpg.png') }}" alt="RPG Toolkit">
            <h1>Tu as quelque chose à dire à mes créateurs ? </h1>
            <p>Tu peux passer par discord je te rappelle, sinon, utilise ce formulaire de contact</p>
                <form id="regForm">
                    <div class="formreggrpe">
                        <label for="name">Nom et prénom:</label>
                        <input type="text" id="name" name="name" required placeholder="Entrez votre nom et prénom">
                    </div>
                    <div class="formreggrpe">
                        <label for="email">Mail:</label>
                        <input type="email" id="email" name="email" required placeholder="Entrez votre email">
                    </div>
                    <div class="formreggrpe">
                        <label for="subject">Objet du message:</label>
                        <select id="subject" name="subject" required>
                            <option value="">Sélectionnez un sujet</option>
                            <option value="renseignement">Je demande un renseignement</option>
                            <option value="partenaire">Je veux devenir partenaire</option>
                            <option value="bug">J'ai un bug, help</option>
                            <option value="autres">Autres</option>
                        </select>
                    </div>
                    <div class="formreggrpe">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" required placeholder="Entrez votre message"></textarea>
                    </div>

                    <div class="formreggrpe consent">
                        <input type="checkbox" id="consent" name="consent" required>
                        <label for="consent">J'accepte que mes informations personnelles soient utilisées uniquement pour le RPG TOOLKIT.</label>
                    </div>
                    <button type="submit" class="buttonformtype">Se connecter</button>
                </form>
        </div>
    </div>
@endsection
