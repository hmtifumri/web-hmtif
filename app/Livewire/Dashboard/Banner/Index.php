<?php

namespace App\Livewire\Dashboard\Banner;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithFileUploads;

    #[Validate(['banner.*' => 'required|image|max:3048'])]
    public $banner = [];

    protected $messages = [
        'banner.*.image' => 'File harus berupa gambar',
        'banner.*.max' => 'Gambar maksimal 3mb',
        'banner.*.required' => 'File harus diisi',
    ];

    public function createBanner()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 7) {
            abort(404);
        }
        
        $this->validate();

        try {
            if ($this->banner) {
                foreach ($this->banner as $key => $value) {
                    $imageName = Str::random(32) . '.' . $value->getClientOriginalExtension();
                    $imagePath = $value->storeAs('assets/img/banners', $imageName, 'public');

                    DB::table('banners')->insert([
                        'image' => $imagePath,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                $this->banner = [];
                Session::flash('success', 'Banner berhasil ditambahkan');
            } else {
                Session::flash('error', 'Gagal menambahkan banner');
            }
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat menambahkan banner: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 7) {
            abort(404);
        }

        try {
            $banner = DB::table('banners')->where('id', $id)->first();
            unlink(public_path($banner->image));
            DB::table('banners')->where('id', $id)->delete();

            Session::flash('success', 'Banner berhasil dihapus');
        } catch (\Throwable $th) {
            Session::flash('error', 'Terjadi kesalahan saat menghapus banner: ' . $th->getMessage());
        }
    }

    public function render()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 7) {
            abort(404);
        }
        
        $banners = DB::table('banners')->latest()->get();
        return view('livewire.dashboard.banner.index', [
            'banners' => $banners
        ]);
    }
}
