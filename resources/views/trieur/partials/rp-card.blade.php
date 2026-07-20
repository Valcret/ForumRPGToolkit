<div class="article1">

    <div class="article1haut">
        <div class="iconexemple">
            <a class="exempleicone" href="#"
               wire:click.prevent="toggleFavorite({{ $rp->id }})" title="Favori">
                <i class="bi {{ $rp->is_favorite ? 'bi-star-fill' : 'bi-star' }}"></i>
            </a>
            <a class="exempleicone" href="#"
               wire:click.prevent="markDone({{ $rp->id }})" title="Terminé">
                <i class="bi bi-check-circle"></i>
            </a>
            @if(!$isArchive)
                <a class="exempleicone" href="#"
                   wire:click.prevent="archiveRp({{ $rp->id }})" title="Archiver">
                    <i class="bi bi-archive"></i>
                </a>
            @else
                <a class="exempleicone" href="#"
                   wire:click.prevent="unarchiveRp({{ $rp->id }})" title="Désarchiver">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            @endif
            <a class="exempleicone" href="#"
               wire:click.prevent="editRp({{ $rp->id }})" title="Éditer">
                <i class="bi bi-pen"></i>
            </a>
        </div>
        {{-- Nom du forum --}}
        <div class="fofoarticle">{{ $rp->forum->name ?? '[Forum non défini]' }}</div>
    </div>

    <div class="article1bas">
        <div class="article1gauche">
            <div>
                <div class="exemplechiffre">
                    {{ $loop->iteration }}
                </div>
            </div>
            <div class="article1droitebas">
                {{ $rp->last_reply_at ? $rp->last_reply_at->diffForHumans() : 'Pas de réponse' }}
            </div>
        </div>
        <div class="article1droite">
            <h3>
                <a href="{{ $rp->url ?? '#' }}">{{ $rp->title }}</a>
            </h3>
            <div class="article1droitemilieu">
                @foreach($rp->participants as $participant)
                    <a class="nomp" href="#">{{ $participant->name }}</a>
                    @if(!$loop->last) - @endif
                @endforeach
            </div>
        </div>
    </div>

</div>
