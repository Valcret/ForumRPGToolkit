<div>
    {{-- Liste personnages groupés par forum --}}
    <div class="trieurpersonnagezone">
        @forelse($forums as $forumId => $characters)
            <div class="forumpersonnage">
                <h3>{{ $characters->first()->forum?->name ?? '[À COMPLÉTER]' }}</h3>
                <div class="personnageduforum">
                    @foreach($characters as $character)
                        <div class="name">
                            <h4>{{ $character->name }}</h4>
                            <div class="iconmodoperso">
                                <a href="#" wire:click.prevent="openRpList({{ $character->id }})">
                                    <i class="bi bi-card-list" title="Liste des RPs"></i>
                                </a>
                                <a href="#" wire:click.prevent="confirmArchiveCharacter({{ $character->id }})">
                                    <i class="bi bi-archive" title="Archiver le personnage"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p>Aucun personnage actif.</p>
        @endforelse
            @if($archivedCharacters->isNotEmpty())
                <div class="forumpersonnage archived-section">
                    <h3>Personnages archivés</h3>

                    <div class="archived-characters-list">
                        @foreach($archivedCharacters as $character)
                            <div class="character-card archived name">
                                <h4>{{ $character->name }}</h4>
                                <span class="forum-label">{{ $character->forum?->name ?? 'Sans forum' }}</span>

                                {{-- Modale liste RPs lecture seule --}}
                                <div class="iconmodoperso">
                                    <a href="#" wire:click.prevent="openRpList({{ $character->id }})">
                                        <i class="bi bi-card-list" title="Liste des RPs"></i>
                                    </a>
                                    <a href="#" wire:click.prevent="confirmArchiveCharacter({{ $character->id }})">
                                        <i class="bi bi-archive" title="Archiver le personnage"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
    </div>


    {{-- Modale confirmation archivage --}}
    @if($showArchiveModal)
        <div class="modal-overlay">
            <div class="modal-content">
                <button class="modal-close" wire:click="cancelArchive()">✕</button>
                <p>Archiver ce personnage archivera également tous ses RPs. Confirmer ?</p>
                <div style="display: flex; gap: 10px; width: 100%;">
                    <button class="modal-download" wire:click="archiveCharacter()">
                        <span>Confirmer</span>
                    </button>
                    <button class="modal-download" wire:click="cancelArchive()">
                        <span>Annuler</span>
                    </button>
                </div>
            </div>
        </div>
    @endif


    {{-- Modale liste des RPs --}}
    @if($showRpListModal)
        <div class="modal-overlay">
            <div class="modal-content modal-rp-list">
                <button class="modal-close" wire:click="closeRpList()">✕</button>
                <p>RPs du personnage</p>
                <div class="rp-list" style="width: 100%; overflow-y: auto; max-height: 60vh;">
                    @forelse($this->selectedCharacterRoleplays as $rp)
                        @include('livewire.partials.roleplay-card', [
                            'rp'          => $rp,
                            'isArchive'   => $rp->archived,
                            'isEnAttente' => false,
                            'readOnly'    => true,
                        ])
                    @empty
                        <p>Aucun RP pour ce personnage.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</div>
