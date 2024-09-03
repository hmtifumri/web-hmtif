<?php

namespace App\Livewire\Dashboard\Kepengurusan;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    public $periodeId, $divisionFilter, $pengurus, $search = '';

    #[On('filterPeriode')]
    public function setPeriode($periodeId)
    {
        $this->periodeId = $periodeId;
        $this->loadPengurus();
    }

    #[On('filterDivisi')]
    public function setDivisionFilter($division)
    {
        $this->divisionFilter = $division;
        $this->loadPengurus();
    }

    public function mount()
    {
        $periode_aktif = Periode::where('status', 'aktif')->first();
        $this->periodeId = $periode_aktif ? $periode_aktif->id : null;
        $this->divisionFilter = 'semua';

        $this->loadPengurus();
    }

    public function updatedPeriodeId()
    {
        $this->loadPengurus();
    }

    public function updatedSearch()
    {
        $this->loadPengurus();
    }

    public function loadPengurus()
    {
        $query = User::where('periode_id', $this->periodeId)
            ->where('jabatan', '!=', 'admin');

        if ($this->divisionFilter && $this->divisionFilter !== 'semua') {
            $query->where('divisi_id', $this->divisionFilter);
        }

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            });
        }

        // Menyusun pengurus sesuai urutan jabatan yang diinginkan
        $this->pengurus = $query->orderByRaw("
            CASE 
                WHEN divisi_id = 2 THEN
                    CASE 
                        WHEN jabatan = 'bupati' THEN 1
                        WHEN jabatan = 'wakil_bupati' THEN 2
                        WHEN jabatan = 'sekum' THEN 3
                        WHEN jabatan = 'sekretaris' THEN 4
                        WHEN jabatan = 'bendum' THEN 5
                        ELSE 6
                    END
                ELSE
                    CASE 
                        WHEN jabatan = 'kadiv' THEN 1
                        WHEN jabatan = 'stafsus' THEN 2
                        WHEN jabatan = 'anggota' THEN 3
                        WHEN jabatan = 'magang' THEN 4
                        ELSE 5
                    END
            END
        ")->get();
    }

    public function render()
    {
        $periode = Periode::find($this->periodeId);

        return view('livewire.dashboard.kepengurusan.index', [
            'periode' => $periode,
            'pengurus' => $this->pengurus,
        ]);
    }

    public function hapus($id)
    {
        if (Auth::user()->jabatan !== 'admin') {
            return $this->redirect(route('dashboard'));
        }
        $user = User::find($id);

        if (!$user) {
            return $this->redirect(route('dashboard'));
        }

        if ($user->gambar) {
            Storage::disk('public')->delete($user->gambar);
        }

        $user->delete();
        return $this->redirect(route('kepengurusan.dashboard'));
    }
}
