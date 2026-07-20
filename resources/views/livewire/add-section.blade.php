<div class="ajoutrpfofoperso">
    <div class="ongledajout">
        <div class="container-onglets">
            <div class="onglets {{ $activeTab === 'rp'    ? 'active' : '' }}"
                 wire:click="setTab('rp')">RPs</div>
            <div class="onglets {{ $activeTab === 'forum' ? 'active' : '' }}"
                 wire:click="setTab('forum')">Forum</div>
            <div class="onglets {{ $activeTab === 'perso' ? 'active' : '' }}"
                 wire:click="setTab('perso')">Perso</div>
        </div>

        <div class="contenu active-contenu">
            @if ($activeTab === 'rp')
                <livewire:add-roleplay-form :key="'rp'" />
            @elseif ($activeTab === 'forum')
                <livewire:add-forum-form :key="'forum'" />
            @elseif ($activeTab === 'perso')
                <livewire:add-character-form :key="'perso'" />
            @endif
        </div>
    </div>
</div>
