<?php

namespace App\Livewire\Guest\Home;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]

class Index extends Component
{
    public function render()
    {
        return view('livewire.guest.home.index');
    }
}
