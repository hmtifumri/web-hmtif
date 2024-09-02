<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ArticleByCategory extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $kategori;
    public $sortBy = 'latest';
    public $sortByYear = 'all'; // Tambahkan variabel ini

    public function mount()
    {
        // Ambil nilai sort dari session, jika ada, atau gunakan default
        $this->sortBy = session()->get('sortBy', 'latest');
        $this->sortByYear = session()->get('sortByYear', 'all'); // Ambil nilai tahun dari session
    }

    public function updatedSortBy()
    {
        // Simpan nilai sortBy ke dalam session
        session()->put('sortBy', $this->sortBy);
    }

    public function updatedSortByYear()
    {
        // Simpan nilai sortByYear ke dalam session
        session()->put('sortByYear', $this->sortByYear);
    }

    public function render()
    {
        $query = Article::where('category_id', $this->kategori->id);

        if ($this->sortByYear !== 'all') {
            $query->whereYear('created_at', $this->sortByYear);
        }

        switch ($this->sortBy) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $articles = $query->paginate(10)->withQueryString()->onEachSide(1);

        $years = Article::where('category_id', $this->kategori->id)
            ->selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('livewire.article.article-by-category', [
            'articles' => $articles,
            'years' => $years
        ]);
    }
}
