<?php

namespace App\Livewire\Forms\Guest\KontakKami;

use Livewire\Attributes\Validate;
use Livewire\Form;

class WaForm extends Form
{
    #[Validate(
        'required|string|min:3',
        message: [
            'required' => 'Nama wajib diisi.',
            'min' => 'Nama minimal terdiri dari 3 karakter.',
        ]
    )]
    public string $nama = '';

    #[Validate(
        'required|date|after_or_equal:today',
        message: [
            'required' => 'Tanggal kunjungan wajib diisi.',
            'after_or_equal' => 'Tanggal kunjungan tidak boleh sebelum hari ini.',
        ]
    )]
    public string $tanggal = '';

    #[Validate(
        'required|integer|min:1',
        message: [
            'required' => 'Jumlah tamu wajib diisi.',
            'integer' => 'Jumlah tamu harus berupa angka.',
            'min' => 'Isi jumlah tamu minimal 1 orang.',
        ]
    )]
    public int $tamu = 1;
}
