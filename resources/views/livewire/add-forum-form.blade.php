<div>
    @if($showFlash)
        <div x-data x-init="setTimeout(() => $wire.dismissFlash(), 3000)"
             class="alert-success">
            {{ $flashMessage }}
        </div>
    @endif

    <h3>Remplis le formulaire ci dessous pour ajouter ton forum</h3>

    <form class="formulairetype" wire:submit.prevent="submit">

        <div class="formstylebasic">
            <div class="formstyletexte">
                <label for="name">Nom du forum :</label>
                <input type="text" id="name" wire:model="name" class="full-width"
                       placeholder="Entrez le nom du forum" />
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="formstyletexte">
                <label for="url">Lien de l'index du forum :</label>
                <input type="url" id="url" wire:model="url" class="full-width"
                       placeholder="Entrez le lien de l'index du forum" />
                @error('url') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="formstyletexte">
                <label for="button">Lien URL du bouton en 50x50px :</label>
                <input type="url" id="button" wire:model="button" class="full-width"
                       placeholder="Entrez le lien URL du bouton" />
                @error('button') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>

        <button class="buttonformtype" type="submit">Envoyer</button>
    </form>
</div>
