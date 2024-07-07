<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;

class PeriodeController extends Controller
{
    public function index() {
        $periode = Periode::orderBy('periode', 'asc')->get();

        return view('dashboard.periode', [
            'title' => 'Periode',
            'periode' => $periode
        ]);
    }
}
