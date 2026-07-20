@extends('layouts.fichcraft')

@section('content')

    <script>
        window.__sheetTemplate = @json($sheet->body, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
        window.__storageKey    = 'fichcraft_{{ $forum->id }}_{{ $sheet->id }}';
        window.__isAuth        = {{ auth()->check() ? 'true' : 'false' }};
    </script>

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
                @forelse($forums as $f)
                    <button class="fc">
                        <a href="{{ route('fichcraft.show', $f->id) }}">{{ $f->name }}</a>
                    </button>
                @empty
                    <p>Aucun forum disponible.</p>
                @endforelse
            </div>
        </aside>

        <button class="open-btn">&#9776;</button>

        <section class="fichcraftmain">

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <div class="ficheintro">
                <img class="trieurtoolki" src="{{ asset('images/fich_craft_rpg.png') }}" alt="Toolki">
                <div>
                    <h1>C'est moi, Toolki !</h1>
                    <p>
                        Tu es sur la fiche de <strong>{{ $forum->name }}</strong>.<br>
                        Remplis les champs ci-dessous, le code se génère automatiquement.<br>
                        <em>Connecte-toi pour sauvegarder tes valeurs et les retrouver à ta prochaine visite.</em>
                    </p>
                </div>
            </div>

            <div x-data="sheetApp()" x-init="init()">

                <div class="formfichearemplir">
                    <form class="fichecrafttype" id="sheet-form"
                          action="{{ route('fichcraft.store', $forum->id) }}" method="POST">
                        @csrf

                        <h2>{{ $forum->name }}</h2>
                        <p>{{ $sheet->title }}</p>
                        <hr>

                        @foreach($fields as $field)
                            <div class="fichetypediv">
                                <label for="field_{{ $field }}">
                                    {{ ucfirst(str_replace('_', ' ', $field)) }}
                                </label>
                                <input
                                    type="text"
                                    id="field_{{ $field }}"
                                    name="{{ $field }}"
                                    data-field="{{ $field }}"
                                    class="sheet-input"
                                    placeholder="{{ ucfirst(str_replace('_', ' ', $field)) }}"
                                    value="{{ old($field, $currentSheet?->values[$field] ?? '') }}"
                                >
                            </div>
                        @endforeach

                        <div class="form-actions">
                            <button type="button" class="modal-download" @click="trySave()">
                                <span>Sauvegarder</span>
                            </button>
                            <button type="button" class="modal-download" @click="openPreview()">
                                <span>Visualiser</span>
                            </button>
                            <button type="submit" id="real-submit" style="display:none;"></button>
                        </div>

                    </form>
                </div>

                {{-- Modale Preview --}}
                <div
                    x-show="previewModal"
                    x-cloak
                    class="modal-overlay"
                    @click.self="previewModal = false"
                >
                    <div class="modal-content">
                        <button type="button" class="modal-close" @click.stop="previewModal = false">
                            &times;
                        </button>
                        <p>Code généré</p>
                        <textarea
                            :value="output"
                            rows="20"
                            readonly
                            style="width:100%; font-family:monospace; font-size:0.85rem; resize:vertical;"
                        ></textarea>
                        <div class="modal-download" @click="copy()">
                            <span x-text="copied ? '✓ Copié !' : 'Copier le code'"></span>
                        </div>
                    </div>
                </div>

                {{-- Modale Auth --}}
                <div
                    x-show="authModal"
                    x-cloak
                    class="modal-overlay"
                    @click.self="authModal = false"
                >
                    <div class="modal-content modal-auth">
                        <button type="button" class="modal-close" @click.stop="authModal = false">
                            &times;
                        </button>
                        <img src="{{ asset('images/fich_craft_rpg.png') }}" alt="Toolki" class="modal-toolki">
                        <h2>Hé, par ici !</h2>
                        <p>Pour sauvegarder ta fiche et la retrouver à ta prochaine visite, tu dois être connecté.</p>
                        <div class="modal-auth-actions">
                            <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}" class="modal-download">
                                <span>Se connecter</span>
                            </a>
                            <a href="{{ route('register') }}?redirect={{ urlencode(url()->current()) }}" class="modal-download">
                                <span>S'inscrire</span>
                            </a>
                        </div>
                        <p class="modal-auth-note">
                            Tes valeurs sont déjà sauvegardées localement, elles seront là à ton retour.
                        </p>
                    </div>
                </div>

            </div>{{-- fin x-data --}}

        </section>
    </main>

    <script>
        const OB = '\u007B\u007B';
        const CB = '\u007D\u007D';

        function sheetApp() {
            return {
                previewModal: false,
                authModal:    false,
                output:       '',
                copied:       false,
                template:     window.__sheetTemplate,
                storageKey:   window.__storageKey,
                isAuth:       window.__isAuth,

                init() {
                    this.restoreFromStorage();
                    this.watchInputs();
                },

                restoreFromStorage() {
                    if (this.isAuth) return;

                    const saved = localStorage.getItem(this.storageKey);
                    if (!saved) return;

                    const values = JSON.parse(saved);
                    this.$nextTick(() => {
                        document.querySelectorAll('.sheet-input').forEach(input => {
                            const key = input.dataset.field;
                            if (!input.value && values[key]) {
                                input.value = values[key];
                            }
                        });
                    });
                },

                watchInputs() {
                    document.querySelectorAll('.sheet-input').forEach(input => {
                        input.addEventListener('input', () => {
                            const values = {};
                            document.querySelectorAll('.sheet-input').forEach(i => {
                                values[i.dataset.field] = i.value;
                            });
                            localStorage.setItem(this.storageKey, JSON.stringify(values));
                        });
                    });
                },

                trySave() {
                    if (this.isAuth) {
                        document.getElementById('real-submit').click();
                    } else {
                        this.authModal = true;
                    }
                },

                openPreview() {
                    let result = String(this.template);

                    document.querySelectorAll('.sheet-input').forEach(input => {
                        const key         = input.dataset.field;
                        const value       = (input.value || '').trim();
                        const placeholder = OB + key + CB;
                        result            = result.split(placeholder).join(value || placeholder);
                    });

                    this.output       = result.trim();
                    this.previewModal = true;
                },

                copy() {
                    navigator.clipboard.writeText(this.output).then(() => {
                        this.copied = true;
                        setTimeout(() => this.copied = false, 2000);
                    });
                }
            }
        }
    </script>

@endsection
