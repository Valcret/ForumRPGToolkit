{{-- components/roleplay-card.blade.php --}}
<div class="article1">
    <div class="article1haut">
        <div class="icons">
            @unless($readOnly ?? false)
                {{-- Favori --}}
                <a class="exempleicone" wire:click="toggleFavorite({{ $rp->id }})" href="#">
                    @if($rp->favoritedByUsers->isNotEmpty())
                        <i class="bi bi-star-fill"></i>
                    @else
                        <i class="bi bi-star"></i>
                    @endif
                </a>

                {{-- Archive / Désarchive --}}
                @if($isArchive)
                    @if($rp->archived_by === auth()->id())
                        <a class="exempleicone" wire:click="confirmUnarchive({{ $rp->id }})" href="#">
                            <i class="bi bi-archive-fill"></i>
                        </a>
                    @endif
                @else
                    <a class="exempleicone" wire:click="confirmArchive({{ $rp->id }})" href="#">
                        <i class="bi bi-archive"></i>
                    </a>
                @endif

                {{-- Répondre --}}
                @if(!$isArchive)
                    @if($isEnAttente)
                        <a class="exempleicone" wire:click="forceReply({{ $rp->id }})" href="#">
                            <i class="bi bi-pen"></i>
                        </a>
                    @else
                        <a class="exempleicone" wire:click="reply({{ $rp->id }})" href="#">
                            <i class="bi bi-pen"></i>
                        </a>
                    @endif
                @endif
            @endunless
        </div>
        <div class="fofoarticle">{{ $rp->forum?->name ?? '[À COMPLÉTER]' }}</div>
    </div>

    <div class="article1bas">
        <div class="article1gauche">
            <div class="exemplechiffre">{{ $rp->current_turn }}</div>
            <div class="article1droitebas">{{ $rp->updated_at?->format('d/m/Y') }}</div>
        </div>
        <div class="article1droite">
            <h3><a href="{{ $rp->url }}">{{ $rp->title }}</a></h3>
            <div class="article1droitemilieu">
                @foreach($rp->characters as $char)
                    <a class="nomp" href="#">{{ $char->name }}</a>
                    @if(!$loop->last) - @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
