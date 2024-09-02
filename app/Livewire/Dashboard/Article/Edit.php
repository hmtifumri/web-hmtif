<?php

namespace App\Livewire\Dashboard\Article;

use App\Models\Article;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $artikel, $image, $existingImage, $title, $slug, $value, $trixId, $kategori;

    public function rules()
    {
        return $rules = [
            'title' => 'required',
            'slug' => 'required|unique:articles,slug,' . $this->artikel->id,
            'image' => 'nullable|image|max:3048',
            'value' => 'required',
        ];
    }

    public function mount()
    {
        $artikel = $this->artikel;
        $this->title = $artikel->title;
        $this->slug = $artikel->slug;
        $this->value = $artikel->body;
        $this->kategori = base64_encode($artikel->category_id);
        $this->existingImage = $artikel->image;
        $this->trixId = 'trix-' . uniqid();
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedTitle()
    {
        $this->slug = $this->generateUniqueSlug(Str::slug($this->title));
    }

    private function generateUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $count = 1;

        while (Article::where('slug', $slug)->where('id', '!=', $this->artikel->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }

    public function render()
    {
        $categories = Categories::all();
        return view('livewire.dashboard.article.edit', [
            'categories' => $categories
        ]);
    }

    public function update()
    {
        $this->validate();

        try {
            if ($this->image) {
                $oldImagePath = $this->existingImage;
                Storage::disk('public')->delete($oldImagePath);

                $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');
            } else {
                $imagePath = $this->existingImage;
            }

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'category_id' => base64_decode($this->kategori),
                'author' => auth()->user()->name,
                'is_published' => 1
            ];

            $this->artikel->update($data);

            Session::flash('success', 'Artikel berhasil diperbarui');
            return $this->redirect(route('dashboard.artikel'), navigate: true);
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat memperbarui artikel: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    public function draft()
    {
        $this->validate();

        try {
            if ($this->image) {
                $imageName = Str::slug($this->title) . '.' . $this->image->getClientOriginalExtension();
                $imagePath = $this->image->storeAs('assets/img/articles/' . date('Y'), $imageName, 'public');
            } else {
                $imagePath = $this->existingImage;
            }

            $data = [
                'title' => $this->title,
                'slug' => $this->slug,
                'image' => $imagePath,
                'body' => $this->value,
                'category_id' => base64_decode($this->kategori),
                'is_published' => 0,
                'author' => auth()->user()->name
            ];

            $this->artikel->update($data);

            Session::flash('success', 'Artikel berhasil diperbarui sebagai draft');
            return $this->redirect(route('dashboard.artikel'), navigate: true);
        } catch (\Exception $e) {
            Session::flash('error', 'Terjadi kesalahan saat memperbarui artikel: ' . $e->getMessage());
            return back()->withInput();
        }
    }
}
