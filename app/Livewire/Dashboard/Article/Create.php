<?php

namespace App\Livewire\Dashboard\Article;

use App\Models\Article;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $image, $title, $slug, $value, $trixId, $kategori;

    protected $rules = [
        'title' => 'required',
        'slug' => 'required',
        'image' => 'required|image|max:3048',
        'value' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($value = '')
    {
        $this->value = $value;
        $this->trixId = 'trix-' . uniqid();
    }

    public function updatedTitle()
    {
        $this->slug = $this->generateUniqueSlug(Str::slug($this->title));
    }

    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Article::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function render()
    {
        $categories = Categories::all();
        return view('livewire.dashboard.article.create', [
            'categories' => $categories
        ]);
    }

    public function store()
    {
        $this->validate();

        try {
            $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'category_id' => base64_decode($this->kategori),
                'is_published' => 1,
                'author' => auth()->user()->name
            ];

            Article::create($data);

            Session::flash('success', 'Artikel berhasil ditambahkan');
            return $this->redirect(route('dashboard.artikel'), navigate: true);
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat menambahkan artikel: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function draft()
    {
        $this->validate();

        try {
            $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');
            dd($imagePath);

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'category_id' => base64_decode($this->kategori),
                'is_published' => 0,
                'author' => auth()->user()->name
            ];

            Article::create($data);

            Session::flash('success', 'Artikel berhasil ditambahkan');
            return $this->redirect(route('dashboard.artikel'), navigate: true);
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat menambahkan artikel: ' . $e->getMessage());
            return back()->withInput();
        }
    }
}
