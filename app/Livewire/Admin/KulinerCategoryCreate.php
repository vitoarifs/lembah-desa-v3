<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Tambah Kategori Kuliner - Admin Lembah Desa')]
class KulinerCategoryCreate extends Component
{
    public $nama = '';
    public $slug = '';

    public function updatedNama($value)
    {
        $this->slug = Str::slug($value);
    }

    public function store()
    {
        $validated = $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
        ]);

        Category::create($validated);

        session()->flash('message', 'Kategori kuliner baru berhasil ditambahkan!');
        return redirect()->route('admin.kuliner.kategori.index');
    }

    public function render()
    {
        return view('livewire.admin.kuliner-category-create');
    }
}