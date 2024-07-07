<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
    public $name, $email, $gender, $periode, $gambar, $phone;
    public $croppedImage;

    protected function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->user->id,
            'divisi' => 'required',
            'jabatan' => 'required',
            'periode' => 'required',
            'gender' => 'required',
            'gambar' => 'nullable|image|max:5048',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->divisi = $user->divisi;
        $this->jabatan = $user->jabatan;
        $this->periode = $user->periode_id;
        $this->gender = $user->gender;
        $this->phone = $user->phone;

        $this->divisiOptions = [
            'ksb' => 'KSB',
            'kaderisasi_advokasi' => 'Kaderisasi Advokasi',
            'psdm' => 'Pemberdayaan Sumber Daya Mahasiswa',
            'kerohanian' => 'Kerohanian',
            'humas' => 'Humas',
            'kominfo' => 'Kominfo',
            'kwu' => 'Kewirausahaan',
        ];

        $this->ksbJabatanOptions = [
            'bupati' => 'Bupati',
            'wakil bupati' => 'Wakil Bupati',
            'sekretaris umum' => 'Sekretaris Umum',
            'sekretaris' => 'Sekretaris',
            'bendahara umum' => 'Bendahara Umum',
        ];

        $this->defaultJabatanOptions = [
            'kadiv' => 'Kepala Divisi',
            'stafsus' => 'Staf Khusus',
            'anggota' => 'Anggota',
            'magang' => 'Magang',
        ];

        $ksbPositions = array_keys($this->ksbJabatanOptions);
        $usersWithKsbPosition = User::whereIn('jabatan', $ksbPositions)
            ->exists();

        if ($this->user->divisi !== 'ksb') {
            if ($usersWithKsbPosition) {
                unset($this->divisiOptions['ksb']);
                $this->ksbJabatanOptions = [];
            }
        }

        $this->periodeOptions = Periode::get();
    }

    public function updatedDivisi($value)
    {
        if ($value === 'ksb') {
            $this->showKsbOptions = true;
        } else {
            $this->showKsbOptions = false;
        }
    }

    public function save()
    {
        if (Auth::user()->divisi != 'admin' && Auth::user()->id != $this->user->id) {
            abort(403);
        }
        
        $this->validate();

        if ($this->croppedImage) {
            if ($this->user->gambar) {
                $oldImagePath = 'assets/img/kepengurusan/' . str_replace('/', '-', $this->user->periode->periode) . '/' . $this->user->divisi . '/' . $this->user->gambar;
                Storage::disk('public')->delete($oldImagePath);
            }

            $imageName = Str::slug($this->user->name) . '-' . $this->user->nim . '-' . time() . '.' . $this->croppedImage->getClientOriginalExtension();
            $imagePath = $this->croppedImage->storeAs('assets/img/kepengurusan/' . str_replace('/', '-', $this->user->periode->periode) . '/' . $this->user->divisi, $imageName, 'public');

            $this->user->update(['gambar' => $imageName]);
        }

        if ((int)$this->periode != $this->user->periode_id || $this->divisi != $this->user->divisi) {
            $oldPeriodePath = 'assets/img/kepengurusan/' . str_replace('/', '-', $this->user->periode->periode) . '/' . $this->user->divisi;
            $newPeriodePath = 'assets/img/kepengurusan/' . str_replace('/', '-', $this->periodeOptions->find((int)$this->periode)->periode) . '/' . $this->divisi;
        
            if (!Storage::disk('public')->exists($newPeriodePath)) {
                Storage::disk('public')->makeDirectory($newPeriodePath);
            }
        
            $oldImagePath = $oldPeriodePath . '/' . $this->user->gambar;
            $newImagePath = $newPeriodePath . '/' . $this->user->gambar;
        
            if (Storage::disk('public')->exists($oldImagePath)) {
                Storage::disk('public')->move($oldImagePath, $newImagePath);
            }
        }

        // Update user data
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'divisi' => $this->divisi,
            'jabatan' => $this->jabatan,
            'periode_id' => $this->periode,
            'gender' => $this->gender,
            'phone' => $this->phone,
        ]);


        session()->flash('success', 'Berhasil mengupdate data ' . $this->user->name);

    }


    public function render()
    {
        if (Auth::user()->divisi != 'admin' && Auth::user()->id != $this->user->id) {
            abort(403);
        }
        return view('livewire.dashboard.user.edit');
    }
}
