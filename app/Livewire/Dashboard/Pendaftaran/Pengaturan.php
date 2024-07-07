<?php

namespace App\Livewire\Dashboard\Pendaftaran;

use App\Models\Periode;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Pengaturan extends Component
{
    #[Validate('required|date')]
    public $tanggal_mulai;

    #[Validate('required|date')]
    public $tanggal_selesai;

    #[Validate('required|string')]
    public $deskripsi;

    public $tutup_pendaftaran = false;

    public function bukaPendaftaran() {
        DB::table('pengaturan_pendaftaran')->update([
            'status' => 'dibuka',
            'tanggal_mulai' => $this->tanggal_mulai,
            'tanggal_selesai' => $this->tanggal_selesai,
            'deskripsi' => $this->deskripsi
        ]);

        $this->reset('tanggal_mulai', 'tanggal_selesai', 'deskripsi');
    }

    public function setTutup()
    {
        $this->tutup_pendaftaran = true;
    }

    public function unsetTutup() {
        $this->tutup_pendaftaran = false;
    }

    public function tutupPendaftaran() {
        DB::table('pengaturan_pendaftaran')->update([
            'status' => 'ditutup'
        ]);
    }

    public function render()
    {
        $pengaturan = DB::table('pengaturan_pendaftaran')->first();
        $periode_aktif = Periode::where('status', 'aktif')->first()->periode;
        
        return view('livewire.dashboard.pendaftaran.pengaturan',[
            'pengaturan' => $pengaturan,
            'periode_aktif' => $periode_aktif
        ]);
    }


}
