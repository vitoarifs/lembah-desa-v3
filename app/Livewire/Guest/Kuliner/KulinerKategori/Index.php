<?php

namespace App\Livewire\Guest\Kuliner\KulinerKategori;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Index extends Component
{
    public Category $category;

    public function mount(Category $category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $menus = $this->category->menus()
            ->select('id', 'category_id', 'nama', 'slug', 'harga', 'foto', 'deskripsi')
            ->latest()
            ->get();

        return view('livewire.guest.kuliner.kuliner-kategori.index', [
            'menus' => $menus,
        ]);
    }
}