<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::orderBy('periode', 'asc')->get();

        return view('dashboard.periode', [
            'title' => 'Periode',
            'periode' => $periode
        ]);
    }

    public function detailPeriode($periode)
    {
        $periode = Periode::where('periode', str_replace('-', '/', $periode))->first();
        $divisi = Divisi::all();

        return view('dashboard.detail-periode', [
            'title' => 'Detail Periode',
            'periode' => $periode,
            'divisi' => $divisi
        ]);
    }
}
