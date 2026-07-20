<div>

    @if($showFlash)
        <div x-data x-init="setTimeout(() => $wire.dismissFlash(), 3000)"
             class="alert-success">
            {{ $flashMessage }}
        </div>
    @endif

    <h3>Remplis le formulaire ci dessous pour ajouter ton rp</h3>

    <form class="formulairetype" wire:submit.prevent="submit">

        <div class="formstyletop">

            {{-- Choix du forum --}}
            <div class="formstyleoption">
                <select id="forum_id" wire:model.live="forum_id" class="full-width">
                    <option value="">Choisis ton forum</option>
                    @foreach ($forums as $forum)
                        <option value="{{ $forum->id }}">{{ $forum->name }}</option>
                    @endforeach
                </select>
                @error('forum_id') <span class="error">{{ $message }}</span> @enderror
            </div>

            {{-- Sélecteur de personnage --}}
            <div class="formstyleoption">
                <select id="character_id" wire:model.live="character_id" class="full-width"
                        @if(!$forum_id) disabled @endif>
                    <option value="">
                        {{ $forum_id ? 'Choisis un personnage' : 'Choisis d\'abord un forum' }}
                    </option>
                    @foreach ($characters as $character)
                        <option value="{{ $character->id }}"
                                @if(in_array($character->id, $selectedCharacters)) disabled @endif>
                            {{ $character->name }}
                            @if($character->user_id === auth()->id()) ★ @endif
                        </option>
                    @endforeach
                </select>
                @error('selectedCharacters') <span class="error">{{ $message }}</span> @enderror
            </div>

        </div>

        {{-- Personnages retenus --}}
        <div class="formstylemiddle">
            <div class="formstyletxt">
                @if(count($selectedCharacters) > 0)
                    @foreach($selectedCharacters as $charId)
                        @php $char = $characters->firstWhere('id', $charId) @endphp
                        @if($char)
                            <span class="tag-character {{ $char->user_id === auth()->id() ? 'tag-own' : 'tag-other' }}">
                                {{ $char->name }}
                                @if($char->user_id === auth()->id()) ★ @endif
                                <button type="button" wire:click="removeCharacter({{ $charId }})">✕</button>
                            </span>
                        @endif
                    @endforeach
                @else
                    <p class="placeholder-text">
                        Les personnages participants s'inscriront automatiquement après tes choix
                    </p>
                @endif
            </div>
        </div>

        <div class="formulairestyle2">

            <div class="formstyletxt1">
                <label for="title">Nom du RP :</label>
                <input class="text2" type="text" id="title" wire:model="title"
                       placeholder="Si à lancer, mettre un titre provisoire" />
                @error('title') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div class="formstyletxt1">
                <label for="url">Lien du rp :</label>
                <input class="text3" type="text" id="url" wire:model="url"
                       placeholder="Si à lancer, écrire à lancer ou autre" />
                @error('url') <span class="error">{{ $message }}</span> @enderror
            </div>

        </div>

        <button class="buttonformtype" type="submit">Ajouter</button>
    </form>
</div>
