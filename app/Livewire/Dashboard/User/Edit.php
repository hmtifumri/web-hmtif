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

        $this->divisiOptions = Divisi::all()->pluck('divisi', 'id')->toArray();

        $this->ksbJabatanOptions = [
            'bupati' => 'Bupati',
            'wakil_bupati' => 'Wakil Bupati',
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

        $this->periodeOptions = Periode::all();

        if ($this->user->divisi_id != array_search('ksb', $this->divisiOptions)) {
            if (User::whereIn('jabatan', array_keys($this->ksbJabatanOptions))->exists()) {
                unset($this->divisiOptions[array_search('ksb', $this->divisiOptions)]);
                $this->ksbJabatanOptions = [];
            }
        }
    }

    public function updatedDivisi($value)
    {
        $ksbId = array_search('ksb', $this->divisiOptions);
        if ($value == $ksbId) {
            $this->showKsbOptions = true;
        } else {
            $this->showKsbOptions = false;
        }
    }

    public function save()
    {
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
            $newPeriodePath = 'assets/img/kepengurusan/' . str_replace('/', '-', $this->periodeOptions->find((int)$this->periode)->periode) . '/' . Divisi::find((int)$this->divisi)->singkatan;

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
        ]);

        session()->flash('success', 'Berhasil mengupdate data ' . $this->user->name);
    }

    public function render()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->id != $this->user->id) {
            abort(403);
        }
        return view('livewire.dashboard.user.edit');
    }
}
