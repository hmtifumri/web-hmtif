<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        return view('dashboard.dashboard', [
            'title' => 'Home',
        ]);
    }

    public function kepengurusan() {
        return view('dashboard.kepengurusan', [
            'title' => 'Kepengurusan',
        ]);
    }

    public function pengaturanPendaftaran() 
    {
        return view('dashboard.pengaturan-pendaftaran', [
            'title' => 'Pengaturan Pendaftaran'
        ]);
    }

    public function edit($id)  {
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
