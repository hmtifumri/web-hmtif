<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
	public function index()
	{

		return view('home', [
			'title' => 'Beranda'
		]);
	}

	public function kepengurusan($periode)
	{
		$periode = Periode::where('periode', str_replace('-', '/', $periode))->first();

		// Check if periode is null
		if (!$periode) {
			return redirect(route('home'))->with('error', 'Periode tidak ditemukan.');
		}

		$roles = ['bupati', 'wakil_bupati', 'sekum', 'sekretaris', 'bendum'];

		$users = [];
		foreach ($roles as $role) {
			$users[$role] = User::where('divisi_id', 2)
				->where('periode_id', $periode->id)
				->where('jabatan', $role)
				->first();
		}

		// Remove null values
		$users = array_filter($users);

		return view('kepengurusan', [
			'title' => 'Kepengurusan',
			'periode' => $periode,
			'users' => $users
		]);
	}
}
