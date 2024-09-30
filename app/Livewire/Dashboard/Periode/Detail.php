<?php

namespace App\Livewire\Dashboard\Periode;

use Livewire\Component;
use App\Models\Divisi;
use App\Models\Pembina;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Detail extends Component
{
    use WithFileUploads;

    public $periode;
    public $divisi;
    public $pembina;

    #[Locked]
    public $divisiId;

    #[Validate('required|image')]
    public $image;

    public function mount($periode)
    {
        $this->periode = $periode;
    }

    public function setDivisiId($id)
    {
        $this->divisiId = $id;
    }

    public function updatedImage()
    {
        try {
            $divisi = Divisi::where('id', $this->divisiId)->first();

            if (!$divisi) {
                return $this->redirect(route('periode.dashboard'), navigate: true);
            }

            $existingImage = DB::table('divisi-image')
                ->where('divisi_id', $divisi->id)
                ->where('periode_id', $this->periode->id)
                ->first();

            if ($existingImage) {
                // Delete the existing image
                Storage::disk('public')->delete($existingImage->image);

                // Update with the new image
                $imageName = Str::random(50) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/kepengurusan/' . str_replace('/', '-', $this->periode->periode) . '/' . $divisi->singkatan, $imageName, 'public');

                DB::table('divisi-image')
                    ->where('id', $existingImage->id)
                    ->update([
                        'image' => $imagePath,
                        'updated_at' => now(),
                    ]);

                session()->flash('success', 'Gambar ' . str_replace('-', ' ', $divisi->singkatan) . ' berhasil diperbarui');
                $this->redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)), navigate: true);
            } else {
                // Insert new image
                $imageName = Str::random(50) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/kepengurusan/' . str_replace('/', '-', $this->periode->periode) . '/' . $divisi->singkatan, $imageName, 'public');

                DB::table('divisi-image')->insert([
                    'divisi_id' => $divisi->id,
                    'image' => $imagePath,
                    'periode_id' => $this->periode->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            session()->flash('success', 'Gambar ' . str_replace('-', ' ', $divisi->singkatan) . ' berhasil ditambahkan');
            $this->redirect(route('detail.periode', str_replace('/', '-', $this->periode->periode)), navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat menambahkan gambar: ' . $th->getMessage());
        }
    }

    public function render()
    {
        
        return view('livewire.dashboard.periode.detail');
    }
}
