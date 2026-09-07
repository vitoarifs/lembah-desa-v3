<?php

namespace App\Livewire\Forms\Guest\KontakKami;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EmailForm extends Form
{
    #[Validate('required|string|min:3', message: 'Nama lengkap wajib diisi')]
    public string $nama = '';

    #[Validate('required|email', message: 'Format email tidak valid')]
    public string $address = '';

    #[Validate('required|string|min:10', message: 'Pesan minimal 10 karakter')]
    public string $pesan = '';
}
