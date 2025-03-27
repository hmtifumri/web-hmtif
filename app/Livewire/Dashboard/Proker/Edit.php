<?php

namespace App\Livewire\Dashboard\Proker;

use App\Models\Divisi;
use App\Models\Periode;
use App\Models\Proker;
use App\Models\ProkerImages;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $proker, $nama, $image, $tanggal, $slug, $divisi, $trixId, $value, $periode, $fotoKegiatan, $existingFotoKegiatan = [];

    protected $rules = [
        'nama' => 'required',
        'divisi' => 'required',
        'image' => 'nullable|image|max:3048', // Image can be nullable when editing
        'periode' => 'required',
        'fotoKegiatan.*' => 'nullable|image|max:4048', // Nullable because some photos may already exist
        'tanggal' => 'required|date',
        'value' => 'required',
    ];

    protected $messages = [
        'required' => ':attribute harus diisi',
        'image' => ':attribute harus berupa gambar',
        'max' => ':attribute tidak boleh lebih dari :max KB',
        'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobyte',
        'date' => ':attribute harus berupa tanggal',
    ];

    public function mount()
    {;
        $periode = Periode::where('periode', str_replace('-', '/', $this->periode))->first();

        $this->nama = $this->proker->nama;
        $this->slug = $this->proker->slug;
        $this->tanggal = $this->proker->tanggal_mulai;
        $this->divisi = base64_encode($this->proker->divisi_id ?? 0);
        $this->periode = $periode->periode;
        $this->value = $this->proker->deskripsi;
        $this->existingFotoKegiatan = $this->proker->prokerImages->map(function ($image) {
            return [
                'id' => $image->id,
                'image' => $image->image
            ];
        })->toArray();
        $this->trixId = 'trix-' . uniqid();
    }

    public function render()
    {
        $divisiOptions = Divisi::where('divisi', '!=', 'admin')->get();
        return view('livewire.dashboard.proker.edit', [
            'divisiOptions' => $divisiOptions,
        ]);
    }

    public function updated($propertyName)
    {
        return $this->validateOnly($propertyName);
    }

    public function updatedNama()
    {
        $this->slug = $this->generateUniqueSlug(Str::slug($this->nama));
    }

    public function save()
    {
        $this->validate();

        try {
            $periode = Periode::where('periode', str_replace('-', '/', $this->periode))->first();
            $proker = Proker::findOrFail($this->proker->id);

            // If a new image is uploaded, handle the image upload
            if ($this->image) {
                // Delete old image from storage
                Storage::disk('public')->delete($proker->gambar);

                $imageName = Str::slug($this->nama) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/proker/' . str_replace('/', '-', $this->periode), $imageName, 'public');
                $proker->gambar = $imagePath;
            }

            // Update the Proker data
            $proker->update([
                'nama' => $this->nama,
                'slug' => $this->slug,
                'deskripsi' => $this->value,
                'periode_id' => $periode->id,
                'divisi_id' => base64_decode($this->divisi) == 0 ? null : base64_decode($this->divisi),
                'tanggal_mulai' => $this->tanggal,
            ]);

            // Handle new uploaded images for 'fotoKegiatan'
            if ($this->fotoKegiatan) {
                foreach ($this->fotoKegiatan as $image) {
                    $imageName = Str::random(50) . '.' . $image->getClientOriginalExtension();
                    $imagePath = $image->storeAs('assets/img/proker/' . str_replace('/', '-', $this->periode) . '/' . 'dokumentasi', $imageName, 'public');
                    ProkerImages::create([
                        'image' => $imagePath,
                        'proker_id' => $proker->id,
                    ]);
                }
            }

            session()->flash('success', 'Proker berhasil diperbarui');
            return redirect()->route('dashboard.proker', str_replace('/', '-', $this->periode));
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.proker', str_replace('/', '-', $this->periode))->with('error', 'Terjadi kesalahan saat memperbarui proker: ' . $th->getMessage());
        }
    }

    public function deleteImage($index)
    {
        unset($this->fotoKegiatan[$index]);
    }

    public function deleteExistingImage($id)
    {
        // Hapus existingImage (foto kegiatan) dari database dan file nya
        $prokerImage = ProkerImages::where('id', $id)->first();
        if ($prokerImage) {
            $prokerImage->delete();
        }
        Storage::disk('public')->delete($prokerImage->image);

        // Hapus existingImage ( Foto kegiatan) dari array existingImage
        $this->existingFotoKegiatan = array_filter($this->existingFotoKegiatan, function ($image) use ($id) {
            return $image['id'] !== $id;
        });
    }

    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 2;

        while (Proker::where('slug', $slug)->where('id', '!=', $this->proker->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
