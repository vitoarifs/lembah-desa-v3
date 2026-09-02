<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]

class ManageArticles extends Component
{
    public $articles, $title, $content, $articleId;
    public $isEditMode = false;

    protected $rules = [
        'title' => 'required|min:5',
        'content' => 'required|min:10',
    ];

    public function render()
    {
        $this->articles = Article::latest()->get();
        return view('livewire.manage-articles');
    }

    public function resetInput()
    {
        $this->title = '';
        $this->content = '';
        $this->articleId = null;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->authorize('create', Article::class);
        $this->validate();

        if (Article::where('slug', Str::slug($this->title))->exists()) {
            session()->flash('error', 'Judul artikel sudah ada. Silakan gunakan judul lain.');
            return;
        }

        Article::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
        ]);

        session()->flash('message', 'Artikel Berhasil Ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('update', $article);

        $this->articleId = $id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->isEditMode = true;
    }

    public function update()
    {
        $article = Article::findOrFail($this->articleId);
        $this->authorize('update', $article);
        $this->validate();

        $article->update([
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
        ]);

        session()->flash('message', 'Artikel Berhasil Diperbarui.');
        $this->resetInput();
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);
        $this->authorize('delete', $article);

        $article->delete();
        session()->flash('message', 'Artikel Berhasil Dihapus.');
    }
}

