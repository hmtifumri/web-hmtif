<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Periode;
use App\Models\Divisi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $user;
    public $divisi;
    public $jabatan;
    public $divisiOptions = [];
    public $ksbJabatanOptions = [];
    public $defaultJabatanOptions = [];
    public $showKsbOptions = true;
    public $periodeOptions = [];
    public $name, $email, $gender, $periode, $gambar, $phone, $nim;
    public $croppedImage;

    protected $messages = [
        'name.required' => 'Nama harus diisi.',
        'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
        'nim.required' => 'NIM harus diisi.',
        'nim.unique' => 'NIM sudah terdaftar.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
        'email.unique' => 'Email sudah terdaftar.',
        'divisi.required' => 'Divisi harus diisi.',
        'jabatan.required' => 'Jabatan harus diisi.',
        'periode.required' => 'Periode harus diisi.',
        'gender.required' => 'Jenis kelamin harus diisi.',
        'gambar.image' => 'Gambar harus berupa file gambar.',
    ];

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'nim' => 'required|unique:users,nim,' . $this->user->id,
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'divisi' => 'required',
            'jabatan' => 'required',
            'periode' => 'required',
            'gender' => 'required',
            'gambar' => 'nullable|image',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($user)
    {
        $this->user = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->divisi = $user->divisi_id;
        $this->jabatan = $user->jabatan;
        $this->periode = $user->periode_id;
        $this->gender = $user->gender;
        $this->phone = $user->phone;
        $this->nim = $user->nim;

        $this->divisiOptions = Divisi::all()->pluck('divisi', 'id')->toArray();

        $this->ksbJabatanOptions = [
            'bupati' => 'Bupati',
            'wakil_bupati' => 'Wakil Bupati',
            'sekum' => 'Sekretaris Umum',
            'sekretaris' => 'Sekretaris',
            'bendum' => 'Bendahara Umum',
        ];

        $this->defaultJabatanOptions = [
            'kadiv' => 'Kepala Divisi',
            'stafsus' => 'Staf Khusus',
            'anggota' => 'Anggota',
            'magang' => 'Magang',
        ];

        $this->periodeOptions = Periode::all();

        // if ($this->user->divisi_id != array_search('ksb', $this->divisiOptions)) {
        //     if (User::whereIn('jabatan', array_keys($this->ksbJabatanOptions))->exists()) {
        //         unset($this->divisiOptions[array_search('ksb', $this->divisiOptions)]);
        //         $this->ksbJabatanOptions = [];
        //     }
        // }

    }

    public function updatedDivisi($value)
    {
        $ksbId = array_search('ksb', $this->divisiOptions);
        $this->showKsbOptions = $value == $ksbId;
    }

    public function save()
    {
        try {
            if (Auth::user()->jabatan != 'admin' && Auth::user()->id != $this->user->id) {
                abort(403);
            }

            $this->validate();

            if ($this->croppedImage) {
                if ($this->user->gambar) {
                    $oldImagePath = 'assets/img/kepengurusan/' . str_replace('/', '-', $this->user->periode->periode) . '/' . $this->user->divisi->singkatan . '/' . $this->user->gambar;
                    Storage::disk('public')->delete($oldImagePath);
                }

                $imageName = Str::slug($this->user->name) . '-' . $this->user->nim . '-' . time() . '.' . $this->croppedImage->getClientOriginalExtension();
                $imagePath = $this->croppedImage->storeAs('assets/img/kepengurusan/' . str_replace('/', '-', $this->user->periode->periode) . '/' . $this->user->divisi->singkatan, $imageName, 'public');

                $this->user->update(['gambar' => $imagePath]);
            }

            if ((int)$this->periode != $this->user->periode_id || $this->divisi != $this->user->divisi_id) {
                $oldPeriodePath = 'assets/img/kepengurusan/' . str_replace('/', '-', $this->user->periode->periode) . '/' . $this->user->divisi->singkatan;
                $newPeriode = Periode::find((int)$this->periode);
                $newDivisi = Divisi::find((int)$this->divisi);
                $newPeriodePath = 'assets/img/kepengurusan/' . str_replace('/', '-', $newPeriode->periode) . '/' . $newDivisi->singkatan;

                if (!Storage::disk('public')->exists($newPeriodePath)) {
                    Storage::disk('public')->makeDirectory($newPeriodePath);
                }

                $oldImagePath = $oldPeriodePath . '/' . $this->user->gambar;
                $newImagePath = $newPeriodePath . '/' . $this->user->gambar;

                if (Storage::disk('public')->exists($oldImagePath)) {
                    Storage::disk('public')->move($oldImagePath, $newImagePath);
                }
            }

            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'divisi_id' => $this->divisi,
                'jabatan' => $this->jabatan,
                'periode_id' => $this->periode,
                'gender' => $this->gender,
                'phone' => $this->phone,
                'nim' => $this->nim,
            ]);

            session()->flash('success', 'Berhasil mengupdate data ' . $this->user->name);
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat mengupdate data: ' . $th->getMessage());
            return back()->withInput();
        }
    }

    public function render()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->id != $this->user->id) {
            abort(403);
        }
        return view('livewire.dashboard.user.edit');
    }
}
