<?php

namespace App\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $sortBy = 'latest';
    public $sortByYear = 'all';

    public function mount()
    {
        // Ambil nilai sort dari session, jika ada, atau gunakan default
        $this->sortBy = session()->get('sortBy', 'latest');
        $this->sortByYear = session()->get('sortByYear', 'all');
    }

    public function updatedSortBy()
    {
        // Simpan nilai sortBy ke dalam session
        session()->put('sortBy', $this->sortBy);
        $this->resetPage(); // Reset halaman pagination saat sort berubah
    }

    public function updatedSortByYear()
    {
        // Simpan nilai sortByYear ke dalam session
        session()->put('sortByYear', $this->sortByYear);
        $this->resetPage(); // Reset halaman pagination saat filter tahun berubah
    }

    public function render()
    {
        $query = Article::query();

        // Filter berdasarkan tahun
        if ($this->sortByYear !== 'all') {
            $query->whereYear('created_at', $this->sortByYear);
        }

        // Sort berdasarkan tanggal
        switch ($this->sortBy) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $articles = $query->where('is_published', '1')->latest()->paginate(10)->withQueryString()->onEachSide(1);

        // Ambil daftar tahun untuk dropdown
        $years = Article::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('livewire.article.index', [
            'articles' => $articles,
            'years' => $years
        ]);
    }
}
