<?php

namespace App\Livewire\Dashboard\Article;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    #[Url(as: 'judul')]
    public $search = '';

    public function render()
    {
        $articles = Article::where('title', 'like', '%' . $this->search . '%')->paginate(15)->withQueryString()->onEachSide(1);
        return view('livewire.dashboard.article.index', [
            'articles' => $articles
        ]);
    }

    public function delete($id)
    {
        if (!Auth::user()->jabatan == 'admin' || !Auth::user()->divisi_id == 7) {
            abort(404);
        }

        try {
            $article = Article::findOrFail($id);

            $article->image ? Storage::disk('public')->delete($article->image) : '';
            $article->delete();

            session()->flash('success', 'Artikel berhasil dihapus.');
            return $this->redirect(route('dashboard.artikel'), navigate: true);
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan saat menghapus artikel: ' . $th->getMessage());
            return $this->redirect(route('dashboard.artikel'), navigate: true);
        }
    }

    public function setPublish($id)
    {
        $article = Article::where('id', $id)->first();

        if (!$article) {
            session()->flash('success', 'Artikel tidak ditemukan.');
            return;
        }

        if ($article->is_published == 1) {
            $article->update([
                'is_published' => 0
            ]);
        } else {
            $article->update([
                'is_published' => 1
            ]);
        }
    }
}
