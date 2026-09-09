<?php

namespace App\Livewire\Guest\Kuliner\KulinerKategori\KulinerDetail;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.guest.kuliner.kuliner-kategori.kuliner-detail.index');
    }
}
