<?php

namespace App\Livewire\Home\Galeri;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProkerImages;

class Index extends Component
{
    use WithPagination;

    public $perPage = 9;
    public $hasMorePages = true;
    public $years = [];
    public $selectedYear;

    public function mount()
    {
        $this->years = ProkerImages::selectRaw('YEAR(created_at) as year')->distinct()->pluck('year')->toArray(); 
        $this->selectedYear = $this->years[0] ?? null;
    }

    public function updatedSelectedYear() {
        $this->perPage = 9;
    }

    public function loadMore()
    {
        $this->perPage += 9;
    }

    public function render()
    {
        $images = ProkerImages::whereYear('created_at', $this->selectedYear)
            ->latest()
            ->paginate($this->perPage);

        $this->hasMorePages = $images->hasMorePages();

        return view('livewire.home.galeri.index', [
            'images' => $images->items(),
        ]);
    }
}
