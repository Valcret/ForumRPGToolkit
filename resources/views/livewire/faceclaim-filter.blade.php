<main
    class="fichecraft"
    x-data="{
        open: false,
        image: null,
        openModal(url, name, id) {
            this.image = { url, name, id };
            this.open = true;
        }
    }"
>

    {{-- MENU LATERAL --}}
    <aside class="menufichecraft">

        <button class="close-btn">&times;</button>

        <a href="{{ route('home') }}"><img src="{{ asset('images/Toolkit_rpg.png') }}"></a>
        <div class="adminconnect">
            {{-- [À COMPLÉTER] lien connexion admin --}}
        </div>

        <div class="buttonfilter">
            <button class="filter" wire:click="resetFilters">
                <a>Réinitialiser</a>
            </button>
        </div>
        <div class="search-bar" id="avatarCheck">
            <input
                type="text"
                wire:model="search"
                wire:keydown.enter="submitSearch"
                placeholder="Rechercher par nom..."
            />
            <button wire:click="submitSearch" class="modal-download">
                <span>🔎</span>
            </button>
        </div>
        <div class="filterfacelaim">
            <div class="filterzone">

                <span>Couleur des yeux</span>
                <hr>
                <ul>
                    @foreach($eyes as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedEyes" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Couleur des cheveux</span>
                <hr>
                <ul>
                    @foreach($hairs as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedHair" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Longueur des cheveux</span>
                <hr>
                <ul>
                    @foreach($hairLengths as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedHairLength" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Genre</span>
                <hr>
                <ul>
                    @foreach($genders as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedGender" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Âge</span>
                <hr>
                <ul>
                    @foreach($ages as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedAge" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Taille</span>
                <hr>
                <ul>
                    @foreach($sizes as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedSize" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Barbe</span>
                <hr>
                <ul>
                    @foreach($beards as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedBeard" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Historique</span>
                <hr>
                <ul>
                    @foreach($histories as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedHistory" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Format de l'image</span>
                <hr>
                <ul>
                    @foreach($imageSizes as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedImageSize" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

                <span>Autres critères</span>
                <hr>
                <ul>
                    @foreach($otherCriterias as $item)
                        <li>
                            <input type="checkbox" wire:model.live="selectedOther" value="{{ $item->id }}">
                            {{ $item->name }}
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>

    </aside>

    <button class="open-btn">&#9776;</button>

    {{-- SECTION PRINCIPALE --}}
    <section class="facelaim">

        <div class="facelaimintro">
            <img class="trieurtoolki" src="{{ asset('images/Facelaime_rpg.png') }}" alt="Toolki">
            <div>
                <h1>C'est moi, Toolki !</h1>
                <p>Ce facelaim est réservé aux créations de Carmina, tu ne peux pas ajouter tes créations !<br>
                    Mais tu peux en trouver qui te plaisent ! Et ça c'est le top !</p>
            </div>
        </div>

        <div class="avatarfacelaim">
            @forelse($images as $image)
                <div
                    style="position: relative; margin: 10px; cursor: pointer;"
                    @click="openModal(
                        '{{ Storage::url($image->url) }}',
                        '{{ addslashes($image->name) }}',
                        {{ $image->id }}
                    )"
                >
                    <img
                        src="{{ Storage::url($image->url) }}"
                        alt="{{ $image->name }}"
                        @contextmenu.prevent
                    >
                    <div class="info">
                        <p>{{ $image->name }}</p>
                        <p>{{ $image->info?->imageSize?->name ?? '' }}</p>
                    </div>
                </div>
            @empty
                <p>Aucun avatar ne correspond à ta recherche.</p>
            @endforelse
        </div>

    </section>

    {{-- MODALE --}}
    <div
        class="modal-overlay"
        x-show="open"
        x-cloak
        @click.self="open = false"
    >
        <div class="modal-content">

            <button class="modal-close" @click="open = false">&times;</button>

            <img
                :src="image?.url"
                :alt="image?.name"
                @contextmenu.prevent
            >

            <p x-text="image?.name"></p>

            {{-- Dans la modale --}}
            <a
                :href="`/images/${image.id}/download`"
                class="modal-download"
                target="_blank"
            >
                <span>Utiliser l'image</span>
            </a>




        </div>
    </div>

</main>
