<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.dashboard', [
            'title' => 'Home',
        ]);
    }

    public function kepengurusan()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 2 && Auth::user()->jabatan != "kadiv") {
            return redirect(route('dashboard'));
        }
        return view('dashboard.kepengurusan', [
            'title' => 'Kepengurusan',
        ]);
    }

    public function banner()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 7) {
            return redirect(route('dashboard'));
        }

        return view('dashboard.banner', [
            'title' => 'Banner'
        ]);
    }

    public function pengaturanPendaftaran()
    {
        return view('dashboard.pengaturan-pendaftaran', [
            'title' => 'Pengaturan Pendaftaran'
        ]);
    }

    public function edit($id)
    {
        try {
            $id = decrypt($id);
            $user = User::find($id);
        } catch (\Throwable $th) {
            return redirect(route('dashboard'));
        }

        return view('dashboard.edit-user', [
            'title' => 'Edit User',
            'user' => $user
        ]);
    }
}
