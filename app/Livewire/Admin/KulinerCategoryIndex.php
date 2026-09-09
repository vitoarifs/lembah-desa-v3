<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Kategori Kuliner - Admin Lembah Desa')]
class KulinerCategoryIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $isModalOpen = false;
    public $categoryId = null;

    public $nama = '';
    public $slug = '';

    protected $queryString = ['search' => ['except' => '']];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedNama($value)
    {
        $this->slug = Str::slug($value);
    }

    public function openModal()
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['nama', 'slug', 'categoryId']);
        $this->resetValidation();
    }

    public function save()
    {
        $validated = $this->validate([
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($this->categoryId)],
        ]);

        Category::updateOrCreate(
            ['id' => $this->categoryId],
            $validated
        );

        session()->flash('message', $this->categoryId ? 'Kategori berhasil diperbarui!' : 'Kategori baru berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $category->id;
        $this->nama = $category->nama;
        $this->slug = $category->slug;

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        
        // Cek jika kategori memiliki menu terkait
        if ($category->menus()->count() > 0) {
            session()->flash('error', 'Kategori ini tidak dapat dihapus karena masih memiliki menu kuliner!');
            return;
        }

        $category->delete();
        session()->flash('message', 'Kategori berhasil dihapus!');
    }

    public function render()
    {
        $categories = Category::withCount('menus')
            ->where('nama', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.kuliner-category-index', [
            'categories' => $categories,
        ]);
    }
}