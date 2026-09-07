<?php

namespace App\Livewire\Forms\Guest\KontakKami;

use Livewire\Attributes\Validate;
use Livewire\Form;

class WaForm extends Form
{
    #[Validate('required|string|min:3', message: 'Nama wajib diisi')]
    public string $nama = '';

    #[Validate('required|date|after_or_equal:today', message: 'Tanggal kunjungan tidak boleh sebelum hari ini')]
    public string $tanggal = '';

    #[Validate('required|integer|min:1', message: 'Isi jumlah tamu minimal 1')]
    public $tamu = '';
}
