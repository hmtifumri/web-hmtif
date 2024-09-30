<?php

namespace App\Livewire\Home\Proker;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProkerImages;

class Detail extends Component
{
    use WithPagination;

    public $prokerId, $perPage = 6;
    public $infiniteScrollEnabled = false;

    public function render()
    {
        $fotos = ProkerImages::where('proker_id', $this->prokerId)
            ->paginate($this->perPage);

        return view('livewire.home.proker.detail', [
            'fotos' => $fotos->items(),
            'hasMorePages' => $fotos->hasMorePages(),
            'infiniteScrollEnabled' => $this->infiniteScrollEnabled,
        ]);
    }

    public function loadMore()
    {
        $this->perPage += 6;
    }
    
}
