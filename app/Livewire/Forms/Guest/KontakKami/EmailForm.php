<?php

namespace App\Livewire\Forms\Guest\KontakKami;

use Livewire\Attributes\Validate;
use Livewire\Form;

class EmailForm extends Form
{
    #[Validate(
        'required|string|min:3',
        message: [
            'required' => 'Nama lengkap wajib diisi.',
            'min' => 'Nama lengkap minimal terdiri dari 3 karakter.',
        ]
    )]
    public string $nama = '';

    #[Validate(
        'required|email',
        message: [
            'required' => 'Alamat email wajib diisi.',
            'email' => 'Format email tidak valid.',
        ]
    )]
    public string $address = '';

    #[Validate(
        'required|string|min:10',
        message: [
            'required' => 'Pesan wajib diisi.',
            'min' => 'Pesan minimal terdiri dari 10 karakter.',
        ]
    )]
    public string $pesan = '';
}