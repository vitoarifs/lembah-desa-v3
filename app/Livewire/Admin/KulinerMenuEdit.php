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

#[Layout('layouts.app')]
#[Title('Edit Menu Kuliner - Admin Lembah Desa')]
class KulinerMenuEdit extends Component
{
    use WithFileUploads;

    public Menu $menu;

    public $category_id = '';
    public $nama = '';
    public $slug = '';
    public $harga = '';
    public $foto;
    public $existingFoto = null;
    public $deskripsi = '';
    public $isi_paket = [''];

    public function mount(Menu $menu)
    {
        $this->menu = $menu;
        $this->category_id = $menu->category_id;
        $this->nama = $menu->nama;
        $this->slug = $menu->slug;
        $this->harga = $menu->harga;
        $this->existingFoto = $menu->foto;
        $this->deskripsi = $menu->deskripsi;
        $this->isi_paket = !empty($menu->isi_paket) ? $menu->isi_paket : [''];
    }

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

    public function update()
    {
        $validated = $this->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'nama' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('menus', 'slug')->ignore($this->menu->id)],
            'harga' => ['required', 'numeric', 'min:0'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $cleanIsiPaket = array_values(array_filter($this->isi_paket, fn($item) => !empty(trim($item))));
        
        $fotoPath = $this->existingFoto;
        if ($this->foto) {
            if ($this->existingFoto && Storage::disk('public')->exists($this->existingFoto)) {
                Storage::disk('public')->delete($this->existingFoto);
            }
            $fotoPath = $this->foto->store('menus', 'public');
        }

        $this->menu->update([
            'category_id' => $this->category_id,
            'nama' => $this->nama,
            'slug' => $this->slug,
            'harga' => $this->harga,
            'foto' => $fotoPath,
            'deskripsi' => $this->deskripsi,
            'isi_paket' => !empty($cleanIsiPaket) ? $cleanIsiPaket : null,
        ]);

        session()->flash('message', 'Menu kuliner berhasil diperbarui!');
        return redirect()->route('admin.kuliner.menu.index');
    }

    public function render()
    {
        return view('livewire.admin.kuliner-menu-edit', [
            'categories' => Category::orderBy('nama')->get(),
        ]);
    }
}