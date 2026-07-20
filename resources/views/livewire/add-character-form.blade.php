<div>
    @if($showFlash)
        <div x-data x-init="setTimeout(() => $wire.dismissFlash(), 3000)"
             class="alert-success">
            {{ $flashMessage }}
        </div>
    @endif

    <h3>Remplis le formulaire ci dessous pour ajouter ton personnage</h3>

    <form class="formulairetype" wire:submit.prevent="submit">

        <div class="formstylebasic">
            <div class="formstyleperso">
                <select id="forum_id" wire:model="forum_id" class="full-width">
                    <option value="">Choisissez un forum</option>
                    @foreach ($forums as $forum)
                        <option value="{{ $forum->id }}">{{ $forum->name }}</option>
                    @endforeach
                </select>
                @error('forum_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="formstylecenter">
            <div class="formstyletxt">
                <label for="name">Nom du personnage :</label>
                <input type="text" id="name" wire:model="name" class="full-width"
                       placeholder="Entrez le nom du personnage" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="formstyletxt">
                <label for="alt">URL de la fiche du personnage :</label>
                <input type="url" id="alt" wire:model="alt" class="full-width"
                       placeholder="Entrez l'URL de la fiche du personnage" />
                @error('alt') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="formstyleperso">
                <label for="user_id">Choisissez un utilisateur :</label>
                <select id="user_id" wire:model="user_id" class="full-width">
                    <option value="">Sélectionnez un utilisateur</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <button class="buttonformtype" type="submit">Envoyer</button>
    </form>
</div>
