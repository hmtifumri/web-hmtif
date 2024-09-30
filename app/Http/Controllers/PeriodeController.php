<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\Pembina;
use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::orderBy('periode', 'asc')->get();
        if ($periode == null) {
            return redirect(route('dashboard'));
        }

        return view('dashboard.periode', [
            'title' => 'Periode',
            'periode' => $periode
        ]);
    }

    public function detailPeriode($periode)
    {
        $periode = Periode::where('periode', str_replace('-', '/', $periode))->first();

        if (!$periode) {
            return redirect(route('dashboard'));
        }

        $divisi = Divisi::all();
        $pembina = Pembina::where('periode_id', $periode->id)
            ->orderBy('status', 'desc')
            ->orderBy('mulai', 'asc')
            ->get();
            

        return view('dashboard.detail-periode', [
            'title' => 'Detail Periode',
            'periode' => $periode,
            'divisi' => $divisi,
            'pembina' => $pembina
        ]);
    }

    public function editDivisi($periode, $divisi) {
        
        return view('dashboard.edit-divisi', [
            'title' => 'Edit Divisi ' . str_replace('-', ' ', ucwords($divisi)),
            'periode' => $periode,
        ]);
    }
}
