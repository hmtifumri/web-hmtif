<?php

namespace App\Livewire\Dashboard\Periode;

use Livewire\Component;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;

class Index extends Component
{
    public $periode;

    #[Locked]
    public $periodeId;

    public function ubahStatus($id)
    {
        Periode::where('status', 'aktif')->update(['status' => 'tidak aktif']);
        $periode = Periode::find($id);
        $periode->status = $periode->status == 'aktif' ? 'tidak aktif' : 'aktif';
        $periode->save();

        $this->periode = Periode::orderBy('periode', 'asc')->get();
    }

    public function setHapusPeriode($id)
    {
        $this->periodeId = $id;
    }

    public function hapusPeriode()
    {
        try {
            $periode = Periode::find($this->periodeId);
        } catch (\Throwable $th) {
            return $this->redirect(route('periode.dashboard'));
        }

        $users = User::where('periode_id', $periode->id)->get();
        $divisiImages = DB::table('divisi-image')->where('periode_id', $periode->id)->get();

        foreach ($users as $user) {
            // Hapus gambar user jika ada
            if ($user->gambar) {
                $path = 'assets/img/kepengurusan/' . str_replace('/', '-', $periode->periode) . '/' . $user->divisi . '/' . $user->gambar;
                Storage::disk('public')->delete($path);
            }
            $user->delete();
        }

        foreach ($divisiImages as $divisiImage) {
            // Hapus gambar divisi jika ada
            if ($divisiImage->image) {
                $path = $divisiImage->image;
                Storage::disk('public')->delete($path);
            }
            DB::table('divisi-image')->where('id', $divisiImage->id)->delete();
        }

        Storage::disk('public')->deleteDirectory('assets/img/kepengurusan/' . str_replace('/', '-', $periode->periode));

        $periode->delete();

        session()->flash('success', 'Periode berhasil dihapus');
        $this->redirect(route('periode.dashboard'), navigate:true);
    }

    public function render()
    {
        return view('livewire.dashboard.periode.index');
    }
}
