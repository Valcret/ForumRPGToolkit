<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Image;
use App\Models\EyesColor;
use App\Models\HairColor;
use App\Models\HairLength;
use App\Models\Gender;
use App\Models\Age;
use App\Models\Size;
use App\Models\Beard;
use App\Models\History;
use App\Models\ImageSize;
use App\Models\OtherCriteria;
use Illuminate\Support\Facades\Storage;

class FaceclaimFilter extends Component
{
    // --- Filtres ---
    public array $selectedEyes       = [];
    public array $selectedHair       = [];
    public array $selectedHairLength = [];
    public array $selectedGender     = [];
    public array $selectedAge        = [];
    public array $selectedSize       = [];
    public array $selectedBeard      = [];
    public array $selectedHistory    = [];
    public array $selectedImageSize  = [];
    public array $selectedOther      = [];

    // --- Recherche ---
    public string $search = '';

    // Propriété interne qui stocke la recherche validée
    // (évite de filtrer à chaque frappe)
    public string $confirmedSearch = '';

    public function submitSearch(): void
    {
        $this->confirmedSearch = trim($this->search);
    }

    public function resetFilters(): void
    {
        $this->selectedEyes       = [];
        $this->selectedHair       = [];
        $this->selectedHairLength = [];
        $this->selectedGender     = [];
        $this->selectedAge        = [];
        $this->selectedSize       = [];
        $this->selectedBeard      = [];
        $this->selectedHistory    = [];
        $this->selectedImageSize  = [];
        $this->selectedOther      = [];

        // ✅ Reset aussi la recherche
        $this->search          = '';
        $this->confirmedSearch = '';
    }

    public function downloadImage(int $id)
    {
        $image = Image::findOrFail($id);
        return Storage::disk('public')->download($image->url, $image->name);
    }

    public function render()
    {
        $query = Image::with([
            'info',
            'info.eyesColor',
            'info.hairColor',
            'info.hairLength',
            'info.gender',
            'info.age',
            'info.size',
            'info.beard',
            'info.history',
            'info.imageSize',
            'otherCriterias',
        ]);

        // --- Filtre recherche par nom ---
        if (!empty($this->confirmedSearch)) {
            $query->where('name', 'like', '%' . $this->confirmedSearch . '%');
        }

        // --- Filtres existants ---
        if (!empty($this->selectedEyes)) {
            $query->whereHas('info', fn($q) => $q->whereIn('eyes_color_id', $this->selectedEyes));
        }
        if (!empty($this->selectedHair)) {
            $query->whereHas('info', fn($q) => $q->whereIn('hair_color_id', $this->selectedHair));
        }
        if (!empty($this->selectedHairLength)) {
            $query->whereHas('info', fn($q) => $q->whereIn('hair_length_id', $this->selectedHairLength));
        }
        if (!empty($this->selectedGender)) {
            $query->whereHas('info', fn($q) => $q->whereIn('gender_id', $this->selectedGender));
        }
        if (!empty($this->selectedAge)) {
            $query->whereHas('info', fn($q) => $q->whereIn('age_id', $this->selectedAge));
        }
        if (!empty($this->selectedSize)) {
            $query->whereHas('info', fn($q) => $q->whereIn('size_id', $this->selectedSize));
        }
        if (!empty($this->selectedBeard)) {
            $query->whereHas('info', fn($q) => $q->whereIn('beard_id', $this->selectedBeard));
        }
        if (!empty($this->selectedHistory)) {
            $query->whereHas('info', fn($q) => $q->whereIn('history_id', $this->selectedHistory));
        }
        if (!empty($this->selectedImageSize)) {
            $query->whereHas('info', fn($q) => $q->whereIn('image_size_id', $this->selectedImageSize));
        }
        if (!empty($this->selectedOther)) {
            $query->whereHas('otherCriterias', fn($q) => $q->whereIn('other_criteria_id', $this->selectedOther));
        }

        return view('livewire.faceclaim-filter', [
            'images'         => $query->get(),
            'eyes'           => EyesColor::all(),
            'hairs'          => HairColor::all(),
            'hairLengths'    => HairLength::all(),
            'genders'        => Gender::all(),
            'ages'           => Age::all(),
            'sizes'          => Size::all(),
            'beards'         => Beard::all(),
            'histories'      => History::all(),
            'imageSizes'     => ImageSize::all(),
            'otherCriterias' => OtherCriteria::all(),
        ]);
    }
}
