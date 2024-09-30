<?php

namespace App\Livewire\Dashboard\Divisi;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $divisi, $periode, $divisiImage, $newImage, $trixId, $value;

    protected $rules = [
        'newImage' => 'nullable|image|max:3048',
        'value' => 'nullable',
    ];

    protected $messages = [
        'max' => 'Maksimal :max karakter',
        'image' => 'File harus berupa gambar',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->divisiImage = $this->divisi->images()->first();
        $this->trixId = 'trix-' . uniqid();

        if ($this->divisiImage && $this->divisiImage->deskripsi != null) {
            $this->value = $this->divisiImage->deskripsi;
        }
    }

    public function update()
    {
        $this->validate();

        try {
            if ($this->divisiImage) {
                if ($this->newImage) {
                    $oldImagePath = $this->divisiImage->image;
                    Storage::disk('public')->delete($oldImagePath);

                    $imageName =  Str::random(50) . '.' . $this->newImage->getClientOriginalExtension();
                    $imagePath = $this->newImage->storeAs('assets/img/kepengurusan/' . str_replace('/', '-', $this->periode->periode) . '/' . $this->divisi->singkatan, $imageName, 'public');

                    $this->divisiImage->update(['image' => $imagePath]);
                }

                $this->divisiImage->update(['deskripsi' => $this->value]);
            } else {
                $imageName =  Str::random(50) . '.' . $this->newImage->getClientOriginalExtension();
                $imagePath = $this->newImage->storeAs('assets/img/kepengurusan/' . str_replace('/', '-', $this->periode->periode) . '/' . $this->divisi->singkatan, $imageName, 'public');

                $this->divisi->images()->create([
                    'image' => $imagePath,
                    'deskripsi' => $this->value,
                    'divisi_id' => $this->divisi->id,
                    'periode_id' => $this->periode->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            session()->flash('success', 'Divisi berhasil diupdate');
            if (Auth::user()->jabatan == 'admin') {
                return $this->redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)), navigate: true);
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat mengupdate divisi: ' . $th->getMessage());
            if (Auth::user()->jabatan == 'admin') {
                return $this->redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)), navigate: true);
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.divisi.edit');
    }
}
