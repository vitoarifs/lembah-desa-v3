<?php

namespace App\Livewire\Guest\Kuliner\KulinerKategori\KulinerDetail;

use App\Models\Category;
use App\Models\Menu;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Index extends Component
{
    public Menu $menu;

    public function mount(Category $category, Menu $menu)
    {
        // Memastikan menu benar-benar milik kategori terkait di URL
        abort_if($menu->category_id !== $category->id, 404);

        // Load relasi category secara efisien
        $this->menu = $menu->load('category');
    }

    public function render()
    {
        return view('livewire.guest.kuliner.kuliner-kategori.kuliner-detail.index');
    }
}