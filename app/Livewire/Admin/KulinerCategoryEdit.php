<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Edit Kategori Kuliner - Admin Lembah Desa')]
class KulinerCategoryEdit extends Component
{
    public Category $category;
    public $nama = '';
    public $slug = '';

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->nama = $category->nama;
        $this->slug = $category->slug;
    }

    public function updatedNama($value)
    {
        $this->slug = Str::slug($value);
    }

    public function update()
    {
        $validated = $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($this->category->id)],
        ]);

        $this->category->update($validated);

        session()->flash('message', 'Kategori kuliner berhasil diperbarui!');
        return redirect()->route('admin.kuliner.kategori.index');
    }

    public function render()
    {
        return view('livewire.admin.kuliner-category-edit');
    }
}