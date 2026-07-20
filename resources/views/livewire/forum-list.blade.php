<div>
    {{-- Liste des forums --}}
    <div class="trieurpersonnagezone">
        @forelse($forums as $forum)
            <div class="listeforum">
                <div class="entetefofo">
                    <a href="#">
                        <img src="{{ $forum->button ?? asset('images/Toolkit_rpg.png') }}" />
                    </a>
                    <h3>{{ $forum->name }}</h3>
                </div>
                <div class="listefofo">
                    <div class="iconmodofofo">
                        <a href="#" wire:click.prevent="openRpList({{ $forum->id }})">
                            <i class="bi bi-card-list" title="Liste des RPs"></i>
                        </a>
                        <a href="#" wire:click.prevent="openCharacterList({{ $forum->id }})">
                            <i class="bi bi-person-bounding-box" title="Liste des personnages"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p>Aucun forum actif.</p>
        @endforelse
    </div>

    {{-- Modale liste des RPs --}}
    @if($showRpModal)
        <div class="modal-overlay">
            <div class="modal-content modal-rp-list">
                <button class="modal-close" wire:click="closeModals()">✕</button>
                <p>RPs du forum</p>
                <div class="rp-list" style="width: 100%; overflow-y: auto; max-height: 60vh;">
                    @forelse($this->selectedForumRoleplays as $rp)
                        @include('livewire.partials.roleplay-card', [
                            'rp'          => $rp,
                            'isArchive'   => $rp->archived,
                            'isEnAttente' => false,
                            'readOnly'    => true,
                        ])
                    @empty
                        <p>Aucun RP pour ce forum.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif

    {{-- Modale liste des personnages --}}
    @if($showCharacterModal)
        <div class="modal-overlay">
            <div class="modal-content modal-rp-list perso-list">
                <button class="modal-close" wire:click="closeModals()">✕</button>
                <p>Personnages du forum</p>
                <div class="rp-list" style="width: 100%; overflow-y: auto; max-height: 60vh;">
                    @forelse($this->selectedForumCharacters as $character)
                        <div class="forumpersonnage">
                            <div class="personnageduforum">
                                <div class="name">
                                    <h4>{{ $character->name }}</h4>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>Aucun personnage pour ce forum.</p>
                    @endforelse
                </div>
            </div>
        </div>
    @endif
</div>
