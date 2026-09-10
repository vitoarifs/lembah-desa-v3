<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout('layouts.app')]
#[Title('Kelola Menu Kuliner - Admin Lembah Desa')]
class KulinerMenuIndex extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $categoryFilter = '';
    public $isModalOpen = false;
    public $menuId = null;

    // Form fields
    public $category_id = '';
    public $nama = '';
    public $slug = '';
    public $harga = '';
    public $foto;
    public $existingFoto = null;
    public $deskripsi = '';
    public $isi_paket = [''];

    protected $queryString = ['search' => ['except' => ''], 'categoryFilter' => ['except' => '']];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatedNama($value)
    {
        $this->slug = Str::slug($value);
    }

    // Kelola Array Dinamis Isi Paket
    public function addIsiPaket()
    {
        $this->isi_paket[] = '';
    }

    public function removeIsiPaket($index)
    {
        unset($this->isi_paket[$index]);
        $this->isi_paket = array_values($this->isi_paket);
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
        $this->reset(['category_id', 'nama', 'slug', 'harga', 'foto', 'existingFoto', 'deskripsi', 'menuId']);
        $this->isi_paket = [''];
        $this->resetValidation();
    }

    public function save()
    {
        $validated = $this->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('menus', 'slug')->ignore($this->menuId)],
            'harga' => ['required', 'numeric', 'min:0'],
            'foto' => [$this->menuId ? 'nullable' : 'required', 'image', 'max:2048'], // Max 2MB
            'deskripsi' => ['nullable', 'string'],
        ]);

        // Bersihkan array isi_paket dari string kosong
        $cleanIsiPaket = array_values(array_filter($this->isi_paket, fn($item) => !empty(trim($item))));

        $fotoPath = $this->existingFoto;
        if ($this->foto) {
            // Hapus foto lama jika sedang memperbarui
            if ($this->existingFoto && Storage::disk('public')->exists($this->existingFoto)) {
                Storage::disk('public')->delete($this->existingFoto);
            }
            $fotoPath = $this->foto->store('menus', 'public');
        }

        Menu::updateOrCreate(
            ['id' => $this->menuId],
            [
                'category_id' => $this->category_id,
                'nama' => $this->nama,
                'slug' => $this->slug,
                'harga' => $this->harga,
                'foto' => $fotoPath,
                'deskripsi' => $this->deskripsi ?: null,
                'isi_paket' => !empty($cleanIsiPaket) ? $cleanIsiPaket : null,
            ]
        );

        session()->flash('message', $this->menuId ? 'Menu kuliner berhasil diperbarui!' : 'Menu kuliner baru berhasil ditambahkan!');
        $this->closeModal();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $this->menuId = $menu->id;
        $this->category_id = $menu->category_id;
        $this->nama = $menu->nama;
        $this->slug = $menu->slug;
        $this->harga = $menu->harga;
        $this->existingFoto = $menu->foto;
        $this->deskripsi = $menu->deskripsi;
        $this->isi_paket = !empty($menu->isi_paket) ? $menu->isi_paket : [''];

        $this->isModalOpen = true;
    }

    public function delete($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->foto && Storage::disk('public')->exists($menu->foto)) {
            Storage::disk('public')->delete($menu->foto);
        }

        $menu->delete();
        session()->flash('message', 'Menu kuliner berhasil dihapus!');
    }

    public function render()
    {
        $menus = Menu::with('category')
            ->when($this->search, function ($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.kuliner-menu-index', [
            'menus' => $menus,
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }
}