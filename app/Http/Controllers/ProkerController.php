<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Proker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProkerController extends Controller
{
    public function index($periode)
    {
        $periodeId = Periode::where('periode', str_replace('-', '/', $periode))->pluck('id')->first();

        if (!$periodeId) {
            return redirect(route('dashboard'));
        }

        if (Auth::user()->jabatan == 'admin') {
            $proker = Proker::where('periode_id', $periodeId)->orderBy('tanggal_mulai', 'desc')->get();
        } else {
            $proker = Proker::where('periode_id', $periodeId)->where('divisi_id', Auth::user()->divisi_id)->orderBy('tanggal_mulai', 'desc')->get();
        }


        return view('dashboard.proker', [
            'title' => 'Proker HM-TIF ' . $periode,
            'periode' => $periode,
            'proker' => $proker
        ]);
    }

    public function show($periode, $divisi, $slug)
    {
        $proker = Proker::where('slug', $slug)->first();
        if (!$proker) {
            return redirect(route('dashboard'));
        }

        return view('detail-proker', [
            'title' => 'Proker ' . $divisi . ' ' . $proker->nama,
            'periode' => $periode,
            'proker' => $proker
        ]);
    }

    public function create($periode)
    {
        return view('dashboard.proker-create', [
            'title' => 'Tambah Proker HM-TIF ' . $periode,
            'periode' => $periode
        ]);
    }

    public function edit($periode, $slug)
    {
        $proker = Proker::where('slug', $slug)->first();
        return view('dashboard.proker-edit', [
            'title' => 'Edit Proker HM-TIF',
            'periode' => $periode,
            'proker' => $proker
        ]);
    }
}
