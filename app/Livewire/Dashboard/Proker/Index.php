<?php

namespace App\Livewire\Dashboard\Proker;

use App\Models\Periode;
use Livewire\Component;
use App\Models\Proker;
use App\Models\ProkerImages;
use Illuminate\Support\Facades\Storage;

class Index extends Component
{
    public $periode, $prokers;

    public function mount()
    {
        $periode = Periode::where('periode', str_replace('-', '/', $this->periode))->first();
        $this->prokers = Proker::where('periode_id', $periode->id)->orderBy('tanggal_mulai', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.dashboard.proker.index', [
            'proker' => $this->prokers
        ]);
    }

    public function delete($id)
    {
        try {
            // Hapus gambar utama
            $proker = Proker::find($id);
            if ($proker->gambar) {
                Storage::disk('public')->delete($proker->gambar);
            }

            // Hapus gambar kegiatan
            $prokerImages = ProkerImages::where('proker_id', $id)->get();
            foreach ($prokerImages as $image) {
                Storage::disk('public')->delete($image->image);
                $image->delete();
            }

            // Hapus data proker dari database
            $proker->delete();

            // Reload the proker list to reflect the deletion
            $this->prokers = Proker::where('periode_id', $this->periode)->get();

            session()->flash('success', 'Proker berhasil dihapus');
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus proker: ' . $th->getMessage());
        }
    }
}
