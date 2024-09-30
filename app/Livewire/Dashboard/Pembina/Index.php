<?php

namespace App\Livewire\Dashboard\Pembina;

use App\Models\Pembina;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public $pembina, $periode;

    public function render()
    {
        return view('livewire.dashboard.pembina.index');
    }

    public function delete($id)
    {
        $pembina = Pembina::find($id);
        if (!$pembina) {
            return redirect(route('dashboard'));
        }

        try {

            if ($pembina->image) {
                Storage::disk('public')->delete($pembina->image);
            }

            $pembina->delete();
            session()->flash('success', 'Pembina berhasil dihapus');
            return $this->redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)), navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus pembina: ' . $th->getMessage());
            return $this->redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)), navigate: true);
        }
    }
}
