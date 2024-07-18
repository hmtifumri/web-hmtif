<?php

namespace App\Livewire\Dashboard\Periode;

use Livewire\Component;
use App\Models\Periode;
use Illuminate\Validation\Rule;

class TambahPeriode extends Component
{
    public $periode_awal, $periode_akhir;

    public function mount() {
        $this->periode_awal = date('Y');
        $this->periode_akhir = $this->periode_awal + 1;
    }

    public function updatedPeriodeAwal() {
        $this->periode_akhir = $this->periode_awal + 1;
    }

    public function tambahPeriode() {
        // Validasi input
        $this->validate([
            'periode_awal' => ['required', 'integer', 'min:2000', 'max:'.(date('Y') + 1)],
            'periode_akhir' => ['required', 'integer', 'min:2000', 'max:'.(date('Y') + 2)],
        ]);

        $periode = $this->periode_awal . '/' . $this->periode_akhir;

        // Cek apakah periode sudah ada
        if (Periode::where('periode', $periode)->exists()) {
            session()->flash('error', 'Periode sudah ada');
        } else {
            Periode::create([
                'periode' => $periode,
                'status' => 'tidak aktif',
            ]);
            session()->flash('success', 'Periode berhasil ditambahkan');
            return $this->redirect(route('periode.dashboard'), navigate:true);
        }
    }

    public function render() {
        return view('livewire.dashboard.periode.tambah-periode');
    }
}
