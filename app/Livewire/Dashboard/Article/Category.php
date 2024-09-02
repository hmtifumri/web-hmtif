<?php

namespace App\Livewire\Dashboard\Article;

use App\Models\Article;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;

class Category extends Component
{
    public $category = '';
    public $editStatus = false;

    #[Locked]
    public $category_id;

    protected $rules = [
        'category' => 'required|max:255|unique:categories,category',
    ];

    protected $messages = [
        'category.unique' => 'Kategori ini sudah ada.',
        'category.required' => 'Kategori harus diisi.',
        'category.max' => 'Kategori maksimal 255 karakter.',
    ];

    public function createCategory()
    {
        $this->validate();

        Categories::create([
            'category' => $this->category,
            'slug' => Str::slug($this->category),
            'created_at' => now(),
        ]);

        session()->flash('success', 'Kategori berhasil ditambahkan.');

        $this->reset('category'); // Reset the category input field
    }

    public function hapusKategori($id)
    {
        $category = Categories::where('id', $id)->first();

        if (!$category) {
            session()->flash('success', 'Kategori tidak ditemukan.');
            return;
        }

        $articles = Article::where('category_id', $category->id)->get();

        foreach ($articles as $key => $value) {
            if ($value->image) {
                Storage::disk('public')->delete($value->image);
            }
            $value->delete();
        }

        $category->delete();
        session()->flash('success', 'Kategori berhasil dihapus.');

        return $this->redirect(route('dashboard.kategori'));
    }

    public function setEditCategory($id)
    {
        $this->editStatus = true;

        $category = Categories::where('id', $id)->first();

        $this->category = $category->category;
        $this->category_id = $category->id;
    }

    public function cancelEdit()
    {
        $this->reset('category');

        $this->editStatus = false;
    }

    public function updateCategory()
    {
        $this->validate();

        $category = Categories::where('id', $this->category_id)->first();

        if (!$category) {
            session()->flash('success', 'Kategori tidak ditemukan.');
            return;
        }

        $category->update([
            'category' => $this->category,
            'slug' => Str::slug($this->category),
            'updated_at' => now(),
        ]);

        $this->editStatus = false;

        $this->reset('category');

        session()->flash('success', 'Kategori berhasil diperbarui.');
    }

    public function render()
    {
        $categories = Categories::all();

        return view('livewire.dashboard.article.category', [
            'categories' => $categories
        ]);
    }
}
