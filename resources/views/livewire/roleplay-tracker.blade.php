<div class="container-fluid">
    <div class="ajoutrpfofoperso">
        <div class="ongledajout">

            <div class="container-onglets">
                <div class="onglets {{ $activeTab === 'prioritaires' ? 'active' : '' }}"
                     wire:click="$set('activeTab', 'prioritaires')">Prioritaires</div>
                <div class="onglets {{ $activeTab === 'en_cours' ? 'active' : '' }}"
                     wire:click="$set('activeTab', 'en_cours')">En cours</div>
                <div class="onglets {{ $activeTab === 'en_attente' ? 'active' : '' }}"
                     wire:click="$set('activeTab', 'en_attente')">En attente</div>
                <div class="onglets {{ $activeTab === 'archives' ? 'active' : '' }}"
                     wire:click="$set('activeTab', 'archives')">Archivés</div>
            </div>

            <div class="contenu active-contenu">
                <div class="exempleliste">
                    @forelse($this->{$activeTab} as $rp)
                        @include('livewire.partials.roleplay-card', [
                            'rp' => $rp,
                            'isArchive' => $activeTab === 'archives',
                            'isEnAttente' => $activeTab === 'en_attente'
                        ])
                    @empty
                        <p>Aucun RP dans cette catégorie.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    {{-- MODALE ARCHIVAGE --}}
    @if($confirmArchiveId)
        <div class="modal-overlay">
            <div class="modal-content">
                <p>Confirmer l'archivage de ce roleplay ?</p>
                <div class="form-actions">
                    <button class="modal-download" wire:click="archive">
                        <span>Confirmer</span>
                    </button>
                    <button class="modal-download" wire:click="cancelArchive">
                        <span>Annuler</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- MODALE DÉSARCHIVAGE --}}
    @if($confirmUnarchiveId)
        <div class="modal-overlay">
            <div class="modal-content">
                <p>Confirmer le désarchivage de ce roleplay ?</p>
                <div class="form-actions">
                    <button class="modal-download" wire:click="unarchive">
                        <span>Confirmer</span>
                    </button>
                    <button class="modal-download" wire:click="cancelUnarchive">
                        <span>Annuler</span>
                    </button>
                </div>
            </div>
        </div>
    @endif


</div>
