<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 7) {
            abort(404);
        }
        return view('dashboard.artikel', [
            'title' => 'Buat Artikel',
        ]);
    }

    public function create()
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 7) {
            abort(404);
        }
        return view('dashboard.tambah-artikel', [
            'title' => 'Buat Artikel',
        ]);
    }

    public function edit($slug)
    {
        if (Auth::user()->jabatan != 'admin' && Auth::user()->divisi_id != 7) {
            abort(404);
        }

        $artikel = Article::where('slug', $slug)->first();
        
        if (!$artikel) {
            abort(404);
        }

        return view('dashboard.edit-artikel', [
            'title' => 'Edit Artikel ' . ucwords($artikel->title),
            'artikel' => $artikel
        ]);
    }
}
