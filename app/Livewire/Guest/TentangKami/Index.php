<?php

namespace App\Livewire\Guest\TentangKami;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.guest.tentang-kami.index');
    }
}
