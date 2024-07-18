<?php

namespace App\Livewire\Dashboard\Kepengurusan;

use App\Models\Divisi;
use Livewire\Component;
use App\Models\Periode;

class Filter extends Component
{
    public $sortByPeriode, $sortByDivision;

    public function mount()
    {
        $periode_aktif = Periode::where('status', 'aktif')->first();
        $this->sortByPeriode = $periode_aktif ? $periode_aktif->id : null;
        $this->sortByDivision = 'semua';
    }

    public function updatedSortByDivision()
    {
            $this->dispatch('filterDivisi', $this->sortByDivision);
    }

    public function updatedSortByPeriode($value)
    {
        $this->sortByPeriode = $value;
        $this->dispatch('filterPeriode', $this->sortByPeriode);
    }

    public function render()
    {
        $periode = Periode::orderBy('periode', 'asc')->get();
        $divisi = Divisi::all();

        return view('livewire.dashboard.kepengurusan.filter', [
            'periodes' => $periode,
            'divisions' => $divisi
        ]);
    }
}
