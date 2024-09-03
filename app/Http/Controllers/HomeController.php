<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categories;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
	public function index()
	{
		$articles = Article::orderBy('created_at', 'desc')->where('is_published', '1')->take(3)->get();
		$banners = DB::table('banners')->latest()->get();
		return view('home', [
			'title' => 'Beranda',
			'articles' => $articles,
			'banners' => $banners
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

	public function showArticle($slug)
	{
		// Ambil artikel yang sedang ditampilkan
		$article = Article::where('slug', $slug)->first();

		$previousArticle = Article::where('created_at', '<', $article->created_at)
			->orderBy('created_at', 'desc')
			->first();

		$nextArticle = Article::where('created_at', '>', $article->created_at)
			->orderBy('created_at', 'asc')
			->first();

		return view('show-article', [
			'title' => $article->title,
			'article' => $article,
			'previousArticle' => $previousArticle,
			'nextArticle' => $nextArticle,
		]);
	}


	public function artikelByKategori($slug)
	{
		$kategori = Categories::where('slug', $slug)->first();

		return view('articleByCategory', [
			'title' => $kategori->category,
			'kategori' => $kategori
		]);
	}

	public function artikel()
	{
		return view('artikel', [
			'title' => 'Artikel',
		]);
	}
}
