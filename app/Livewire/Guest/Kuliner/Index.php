<?php

namespace App\Livewire\Guest\Kuliner;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.guest.kuliner.index');
    }
}
