<?php

namespace App\Livewire\Dashboard\Pembina;

use App\Models\Pembina;
use App\Models\Periode;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $pembina, $gambar, $nama, $mulai, $selesai, $croppedImage;

    protected $rules = [
        'gambar' => 'nullable|image|max:3048',
        'nama' => 'required',
        'mulai' => 'required|date',
        'selesai' => 'nullable|date',
    ];

    protected $messages = [
        'gambar.max' => 'Ukuran gambar terlalu besar.',
        'gambar.image' => 'File harus berupa gambar.',
        'nama.required' => 'Nama wajib diisi.',
        'mulai.required' => 'Mulai wajib diisi.',
        'mulai.date' => 'Mulai harus berupa tanggal.',
        'selesai.required' => 'Selesai wajib diisi.',
        'selesai.date' => 'Selesai harus berupa tanggal.',
    ];

    public function mount(Pembina $pembina)
    {
        $this->pembina = $pembina;
        $this->nama = $pembina->nama;
        $this->mulai = $pembina->mulai;
        $this->selesai = $pembina->selesai;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update()
    {
        $this->validate();

        try {
            $pembina = $this->pembina;

            if ($this->gambar) {
                // hapus gambar lama
                if ($pembina->image) {
                    Storage::disk('public')->delete($pembina->image);
                }

                $imageName = Str::slug($this->nama) . '-' . time() . '.' . $this->croppedImage->getClientOriginalExtension();
                $imagePath = $this->croppedImage->storeAs('assets/img/pembina/' . str_replace('/', '-', $pembina->periode->periode), $imageName, 'public');
                $pembina->image = $imagePath;
            }

            $selesai = $this->selesai ? $this->selesai : null;

            $status = 0;
            if ($selesai == null) {
                $existingStatusAktif = Pembina::where('periode_id', $pembina->periode->id)->where('status', 1)->first();
                if ($existingStatusAktif && $existingStatusAktif->id != $pembina->id) {
                    $existingStatusAktif->update([
                        'status' => 0,
                        'selesai' => date('Y-m-d'),
                    ]);
                }

                $status = 1;
            }

            $pembina->update([
                'nama' => $this->nama,
                'mulai' => $this->mulai,
                'selesai' => $selesai,
                'status' => $status,
                'updated_at' => now(),
            ]);

            Session::flash('success', 'Pembina berhasil diupdate.');
            return redirect(route('detail.periode', str_replace('/', '-', $pembina->periode->periode)));
        } catch (\Throwable $th) {
            Session::flash('error', 'Pembina gagal diupdate ' . $th->getMessage());
            return redirect(route('detail.periode', str_replace('/', '-', $pembina->periode->periode)));
        }
    }

    public function render()
    {
        return view('livewire.dashboard.pembina.edit');
    }
}
