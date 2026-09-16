<?php

namespace App\Livewire\Guest\KontakKami;

use App\Livewire\Forms\Guest\KontakKami\EmailForm;
use App\Livewire\Forms\Guest\KontakKami\WaForm;
use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use App\Models\SiteIdentity;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.guest')]
class Index extends Component
{
    public WaForm $waForm;

    public EmailForm $emailForm;

    public function sendWa(): void
    {
        $this->waForm->validate();

        $key = 'wa-form:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'waForm.nama' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        RateLimiter::hit($key, 60);

        $identity = SiteIdentity::getSettings();
        $nomorWa = $identity?->nomor_whatsapp;

        $tanggal = Carbon::parse($this->waForm->tanggal)
            ->locale('id')
            ->translatedFormat('j F Y');

        $message = "Halo Lembah Desa, saya ingin melakukan reservasi:\n\n"
            . "• Nama: {$this->waForm->nama}\n"
            . "• Tanggal Kunjungan: {$tanggal}\n"
            . "• Jumlah Tamu: {$this->waForm->tamu} orang\n\n"
            . "Mohon info ketersediaan gazebo/tempat. Terima kasih!";

        $url = "https://wa.me/{$nomorWa}?text=" . urlencode($message);

        $this->dispatch(
            'redirect-to-whatsapp',
            url: $url
        );

        $this->waForm->reset();
    }

    public function sendEmail(): void
    {
        $this->emailForm->validate();

        $key = 'email-form:' . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);

            throw ValidationException::withMessages([
                'emailForm.nama' => "Terlalu banyak percobaan. Silakan coba lagi dalam {$seconds} detik.",
            ]);
        }

        RateLimiter::hit($key, 60);

        $message = ContactMessage::create([
            'nama' => $this->emailForm->nama,
            'email' => $this->emailForm->address,
            'pesan' => $this->emailForm->pesan,
        ]);

        Mail::to(config('mail.from.address'))
            ->send(new ContactMessageMail($message));

        session()->flash(
            'success',
            'Pesan kamu berhasil terkirim! Tim kami akan segera membalas.'
        );

        $this->emailForm->reset();
    }

    public function render()
    {
        return view('livewire.guest.kontak-kami.index');
    }
}