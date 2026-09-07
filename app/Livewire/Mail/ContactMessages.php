<?php

namespace App\Livewire\Mail;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]

class ContactMessages extends Component

{
    public function render()
    {
        return view('livewire.mail.contact-messages',[
            'messages' => \App\Models\ContactMessage::latest()->get()
        ]);
    }
}
