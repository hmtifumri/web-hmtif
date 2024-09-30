<?php

namespace App\Livewire\Dashboard\Pembina;

use App\Models\Pembina;
use App\Models\Periode;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $periode, $gambar, $nama, $mulai, $selesai, $croppedImage;

    protected $rules = [
        'gambar' => 'required|image|max:3048',
        'nama' => 'required',
        'mulai' => 'required|date',
        'selesai' => 'nullable|date',
    ];

    protected $messages = [
        'gambar.max' => 'Ukuran gambar terlalu besar.',
        'gambar.image' => 'File harus berupa gambar.',
        'gambar.required' => 'Gambar wajib diisi.',
        'nama.required' => 'Nama wajib diisi.',
        'mulai.required' => 'Mulai wajib diisi.',
        'mulai.date' => 'Mulai harus berupa tanggal.',
        'selesai.required' => 'Selesai wajib diisi.',
        'selesai.date' => 'Selesai harus berupa tanggal.',
    ];

    public function mount()
    {
        $periode = Periode::where('periode', str_replace('-', '/', $this->periode))->first();
        $this->periode = $periode;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function create()
    {
        $this->validate();

        try {
            $imageName = Str::slug($this->nama) . '-' . time() . '.' . $this->croppedImage->getClientOriginalExtension();
            $imagePath = $this->croppedImage->storeAs('assets/img/pembina/' . str_replace('/', '-', $this->periode->periode), $imageName, 'public');

            $status = 0;
            if ($this->selesai == null) {
                $existingStatusAktif = Pembina::where('periode_id', $this->periode->id)->where('status', 1)->first();
                if ($existingStatusAktif) {
                    $existingStatusAktif->update([
                        'status' => 0,
                        'selesai' => date('Y-m-d'),
                    ]);
                }

                $status = 1;
            }

            $pembina = Pembina::create([
                'nama' => $this->nama,
                'mulai' => $this->mulai,
                'selesai' => $this->selesai,
                'image' => $imagePath,
                'status' => $status,
                'periode_id' => $this->periode->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!$pembina) {
                Session::flash('error', 'Pembina gagal ditambahkan.');
                return redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)));
            }

            Session::flash('success', 'Pembina berhasil ditambahkan.');
            return redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)));
        } catch (\Throwable $th) {
            Session::flash('error', 'Pembina gagal ditambahkan ' . $th->getMessage());
            return redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)));
        }
    }

    public function render()
    {
        return view('livewire.dashboard.pembina.create');
    }
}
