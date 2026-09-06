<?php

namespace App\Livewire\Guest;

use Livewire\Component;

class Header extends Component
{
public string $activeRoute = 'beranda';

    public function setActive($route)
    {
        $this->activeRoute = $route;
    }

    public function render()
    {
        return view('livewire.guest.header');
    }
}
