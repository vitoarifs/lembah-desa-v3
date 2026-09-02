<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]

class PublicArticleIndex extends Component
{
    public function render()
    {
        return view('livewire.public-article-index', [
            'articles' => Article::latest()->get()
        ]);
    }
}
