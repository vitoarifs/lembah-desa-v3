<?php

namespace App\Livewire\Guest\KontakKami;

use App\Livewire\Forms\Guest\KontakKami\EmailForm;
use App\Livewire\Forms\Guest\KontakKami\WaForm;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Index extends Component
{
    // Inisialisasi kedua form object
    public WaForm $waForm;
    public EmailForm $emailForm;

    public function sendWa()
    {
        // Hanya memvalidasi inputan form WhatsApp saja
        $this->waForm->validate();

        $phone = "62895337965404";
        $message = "Halo Lembah Desa, saya ingin melakukan reservasi:\n\n" .
                   "• Nama: {$this->waForm->nama}\n" .
                   "• Tanggal Kunjungan: {$this->waForm->tanggal}\n" .
                   "• Jumlah Tamu: {$this->waForm->tamu} orang\n\n" .
                   "Mohon info ketersediaan gazebo/tempat. Terima kasih!";

        $url = "https://wa.me/{$phone}?text=" . urlencode($message);

        $this->dispatch('open-wa-link', url: $url);
    }

    public function sendEmail()
    {
        // Hanya memvalidasi inputan form Email saja
        $this->emailForm->validate();

        $message = ContactMessage::create([
            'nama' => $this->emailForm->nama,
            'email' => $this->emailForm->address,
            'pesan' => $this->emailForm->pesan,
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactMessageMail($message));

        session()->flash('success', 'Pesan kamu berhasil terkirim! Tim kami akan segera membalas.');
        
        // Reset hanya untuk form email
        $this->emailForm->reset();
    }

    public function render()
    {
        return view('livewire.guest.kontak-kami.index');
    }
}
