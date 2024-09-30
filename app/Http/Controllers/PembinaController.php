<?php

namespace App\Http\Controllers;

use App\Models\Pembina;
use App\Models\Periode;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PembinaController extends Controller
{
    public function create($periode)
    {
        return view('dashboard.pembina-create', [
            'title' => 'Tambah Pembina ' . str_replace('-', '/', $periode),
            'periode' => $periode
        ]);
    }

    public function edit($periode, $id) {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {

            return redirect(route('dashboard'));
        }

        $pembina = Pembina::find($id);
        if (!$pembina) {
            return redirect(route('dashboard'));
        }

        $periode = Periode::where('periode', str_replace('-', '/', $periode))->first();

        return view('dashboard.pembina-edit', [
            'title' => 'Edit Pembina',
            'periode' => $periode,
            'pembina' => $pembina
        ]);
    }
}
