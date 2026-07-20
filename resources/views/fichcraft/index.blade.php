@extends('layouts.fichcraft')

@section('content')
    <main class="fichecraft">
        <aside class="menufichecraft">
            <button class="close-btn">&times;</button>
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/fich_craft_rpg.png') }}" alt="Fich'craft RPG Toolkit">
            </a>
            <div class="aside-auth">
                @auth
                    <div class="aside-user">
                        <span class="aside-username">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                            </svg>
                            {{ auth()->user()->name }}
                        </span>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="aside-auth-link aside-logout">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 13v-2H7V8l-5 4 5 4v-3zM20 3H11a2 2 0 00-2 2v4h2V5h9v14h-9v-4H9v4a2 2 0 002 2h9a2 2 0 002-2V5a2 2 0 00-2-2z"/>
                            </svg>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}" class="aside-auth-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M10 17v-3H3v-4h7V7l5 5-5 5zm9 2H13v-2h6V5h-6V3h6a2 2 0 012 2v14a2 2 0 01-2 2z"/>
                        </svg>
                        Se connecter
                    </a>
                    <a href="{{ route('register') }}?redirect={{ urlencode(url()->current()) }}" class="aside-auth-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M15 12c2.7 0 4.8-2.1 4.8-4.8S17.7 2.4 15 2.4s-4.8 2.1-4.8 4.8S12.3 12 15 12zm-9 2v2H4v-2a7 7 0 017-7 7 7 0 017 7v2h-2v-2a5 5 0 00-10 0z"/>
                        </svg>
                        S'inscrire
                    </a>
                @endauth
            </div>
            <div class="forumficheliste">
                @forelse($forums as $forum)
                    <button class="fc">
                        <a href="{{ route('fichcraft.show', $forum->id) }}">{{ $forum->name }}</a>
                    </button>
                @empty
                    <p>Aucun forum disponible.</p>
                @endforelse
            </div>
        </aside>

        <button class="open-btn">&#9776;</button>

        <section class="fichcraftmain">
            <div class="ficheintro">
                <img class="trieurtoolki" src="{{ asset('images/fich_craft_rpg.png') }}" alt="Toolki">
                <div>
                    <h1>C'est moi, Toolki !</h1>
                    <p>
                        Le forum sur lequel tu joues est un forum partenaire ?<br>
                        Parfait, tu peux choisir son nom dans le menu pour trouver sa fiche.<br>
                        S'il n'y est pas, tu peux le proposer (si tu es l'admin du fofo bien entendu).
                    </p>
                    <div class="text-center">
                        <a href="#" class="footer">Go discord</a>
                        <a href="{{ route('contact') }}" class="footer">Go contact</a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
