<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
#[Title('Tambah Menu Kuliner - Admin Lembah Desa')]
class KulinerMenuCreate extends Component
{
    use WithFileUploads;

    public $category_id = '';
    public $nama = '';
    public $slug = '';
    public $harga = '';
    public $foto;
    public $deskripsi = '';
    public $isi_paket = [''];

    public function updatedNama($value)
    {
        $this->slug = Str::slug($value);
    }

    public function addIsiPaket()
    {
        $this->isi_paket[] = '';
    }

    public function removeIsiPaket($index)
    {
        unset($this->isi_paket[$index]);
        $this->isi_paket = array_values($this->isi_paket);
    }

    public function store()
    {
        $validated = $this->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:menus,slug'],
            'harga' => ['required', 'numeric', 'min:0'],
            'foto' => ['required', 'image', 'max:2048'],
            'deskripsi' => ['required', 'string'],
        ]);

        $cleanIsiPaket = array_values(array_filter($this->isi_paket, fn($item) => !empty(trim($item))));
        $fotoPath = $this->foto->store('menus', 'public');

        Menu::create([
            'category_id' => $this->category_id,
            'nama' => $this->nama,
            'slug' => $this->slug,
            'harga' => $this->harga,
            'foto' => $fotoPath,
            'deskripsi' => $this->deskripsi,
            'isi_paket' => !empty($cleanIsiPaket) ? $cleanIsiPaket : null,
        ]);

        session()->flash('message', 'Menu kuliner baru berhasil ditambahkan!');
        return redirect()->route('admin.kuliner.menu.index');
    }

    public function render()
    {
        return view('livewire.admin.kuliner-menu-create', [
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }
}