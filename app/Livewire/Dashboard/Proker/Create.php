<?php

namespace App\Livewire\Dashboard\Proker;

use App\Models\Divisi;
use App\Models\Periode;
use App\Models\Proker;
use App\Models\ProkerImages;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $nama, $image, $tanggal, $slug, $divisi, $trixId, $value, $periode, $fotoKegiatan;

    protected $rules = [
        'nama' => 'required',
        'divisi' => 'required',
        'image' => 'required|image|max:3048',
        'periode' => 'required',
        'fotoKegiatan.*' => 'required|image|max:4048',
        'tanggal' => 'required|date',
        'value' => 'required',
    ];

    protected $messages = [
        'required' => ':attribute harus diisi',
        'image' => ':attribute harus berupa gambar',
        'max' => ':attribute tidak boleh lebih dari :max karakter',
        'image.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobyte',
        'date' => ':attribute harus berupa tanggal',
    ];

    public function mount($value = '')
    {
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function render()
    {
        if (Auth::user()->jabatan == 'admin') {
            $divisiOptions = Divisi::where('divisi', '!=', 'admin')->get();
        } else {
            $divisiOptions = Divisi::where('divisi', '!=', 'admin')->where('id', Auth::user()->divisi_id)->get();
        }
        return view('livewire.dashboard.proker.create', [
            'divisiOptions' => $divisiOptions
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

    public function create()
    {
        $this->validate();

        try {
            $periode = Periode::where('periode', str_replace('-', '/', $this->periode))->first();
            
            $imageName = Str::slug($this->nama) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('assets/img/proker/' . $this->periode, $imageName, 'public');

            $data = [
                'nama' => $this->nama,
                'slug' => $this->slug,
                'deskripsi' => $this->value,
                'gambar' => $imagePath,
                'periode_id' => $periode->id,
                'divisi_id' => base64_decode($this->divisi) == 0 ? null : base64_decode($this->divisi),
                'created_at' => now(),
                'updated_at' => now(),
                'tanggal_mulai' => $this->tanggal,
            ];

           $proker = Proker::create($data);

            foreach ($this->fotoKegiatan as $key => $image) {
                $imageName = Str::random(50) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('assets/img/proker/' . $this->periode . '/' . 'dokumentasi', $imageName, 'public');
                ProkerImages::create([
                    'image' => $imagePath,
                    'proker_id' => $proker->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            Session()->flash('success', 'Proker berhasil ditambahkan');
            return $this->redirect(route('dashboard.proker', $this->periode), navigate: true);

        } catch (\Throwable $th) {

            return redirect(route('dashboard.proker', $this->periode))->with('error', 'Terjadi kesalahan saat menambahkan proker: ' . $th->getMessage());
        }
    }

    public function deleteImage($index)
    {
        unset($this->fotoKegiatan[$index]);
    }


    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 2;

        while (Proker::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}
