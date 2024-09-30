<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categories;
use App\Models\Pembina;
use App\Models\Periode;
use App\Models\Proker;
use App\Models\ProkerImages;
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
		$prokerImages = ProkerImages::latest()->take(5)->get();
		$proker = Proker::orderBy('tanggal_mulai', 'desc')->take(8)->get();

		return view('home', [
			'title' => 'Beranda',
			'articles' => $articles,
			'banners' => $banners,
			'prokerImages' => $prokerImages,
			'proker' => $proker
		]);
	}

	public function kepengurusan($periode)
	{
		$periode = Periode::where('periode', str_replace('-', '/', $periode))->first();

		if (!$periode) {
			return redirect(route('home'));
		}

		$pembina = Pembina::where('periode_id', $periode->id)->where('status', 1)->first();

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
			'users' => $users,
			'pembina' => $pembina
		]);
	}

	public function showArticle($slug)
	{
		// Ambil artikel yang sedang ditampilkan
		$article = Article::where('slug', $slug)->first();

		if (!$article) {
			return redirect(route('artikel'));
		}

		// update views
		$article->increment('views');

		$previousArticle = Article::where('created_at', '<', $article->created_at)
			->orderBy('created_at', 'desc')
			->first();

		$nextArticle = Article::where('created_at', '>', $article->created_at)
			->orderBy('created_at', 'asc')
			->first();

		// artikel sesuai kategori
		$articleByCategory = Article::where('category_id', $article->category_id)->where('id', '!=', $article->id)->orderBy('created_at', 'desc')->take(6)->get();

		// artikel populer
		$popularArticles = Article::orderBy('views', 'desc')->take(5)->get();

		return view('show-article', [
			'title' => $article->title,
			'article' => $article,
			'previousArticle' => $previousArticle,
			'nextArticle' => $nextArticle,
			'articleByCategory' => $articleByCategory,
			'popularArticles' => $popularArticles
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
