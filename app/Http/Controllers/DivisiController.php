<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class DivisiController extends Controller
{
    public function show($periode, $divisi)
    {
        $periode = Periode::where('periode', str_replace('-', '/', $periode))->first();
        $divisi = Divisi::where('singkatan', $divisi)->select('id', 'singkatan')->first();
        $roles = ['kadiv', 'stafsus', 'anggota', 'magang'];

        // Fetch users or data based on periode and divisi
        $users = User::where('divisi_id', $divisi->id)
            ->where('periode_id', $periode->id)
            ->get()
            ->sortBy(function ($user) use ($roles) {
                return array_search($user->jabatan, $roles);
            });

        if ($users->isEmpty()) {
            return redirect(route('kepengurusan', str_replace('/', '-', $periode->periode)))->with('error', 'Data tidak ditemukan');
        }

        return view('detail-divisi', [
            'title' => 'Divisi ' . ucfirst($divisi->singkatan),
            'periode' => $periode,
            'divisi' => $divisi,
            'users' => $users
        ]);
    }
}
