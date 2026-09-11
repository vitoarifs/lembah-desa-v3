<?php

namespace App\Livewire\Guest\Event;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]

class Index extends Component
{
    public function render()
    {
        $events = Event::where('is_active', true)
            ->orderBy('tanggal', 'asc')
            ->get();

        return view('livewire.guest.event.index', [
            'events' => $events,
        ]);
    }
}
