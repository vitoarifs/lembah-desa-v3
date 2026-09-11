<?php

namespace App\Livewire\Admin\SiteIdentity;

use App\Models\SiteIdentity;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app', ['title' => 'Identitas Website'])]
class Index extends Component
{
    use WithFileUploads;

    public $nama_website;
    public $tagline;
    public $deskripsi_singkat;
    public $nomor_whatsapp;
    public $email;
    public $jam_operasional;
    public $alamat;
    public $link_gmaps;
    public $link_instagram;
    public $link_facebook;
    public $link_tiktok;
    public $link_youtube;

    public $logo;
    public $favicon;
    public $existingLogo;
    public $existingFavicon;

    public function mount()
    {
        $identity = SiteIdentity::first();

        if ($identity) {
            $this->nama_website = $identity->nama_website;
            $this->tagline = $identity->tagline;
            $this->deskripsi_singkat = $identity->deskripsi_singkat;
            $this->nomor_whatsapp = $identity->nomor_whatsapp;
            $this->email = $identity->email;
            $this->jam_operasional = $identity->jam_operasional;
            $this->alamat = $identity->alamat;
            $this->link_gmaps = $identity->link_gmaps;
            $this->link_instagram = $identity->link_instagram;
            $this->link_facebook = $identity->link_facebook;
            $this->link_tiktok = $identity->link_tiktok;
            $this->link_youtube = $identity->link_youtube;
            $this->existingLogo = $identity->logo;
            $this->existingFavicon = $identity->favicon;
        }
    }

    public function save()
    {
        $this->validate([
            'nama_website' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'deskripsi_singkat' => 'nullable|string',
            'nomor_whatsapp' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'jam_operasional' => 'required|string|max:255',
            'alamat' => 'required|string',
            'link_gmaps' => 'nullable|url',
            'link_instagram' => 'nullable|url',
            'link_facebook' => 'nullable|url',
            'link_tiktok' => 'nullable|url',
            'link_youtube' => 'nullable|url',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
        ]);

        $identity = SiteIdentity::first() ?? new SiteIdentity();

        $logoPath = $this->existingLogo;
        if ($this->logo) {
            if ($this->existingLogo && Storage::disk('public')->exists($this->existingLogo)) {
                Storage::disk('public')->delete($this->existingLogo);
            }
            $logoPath = $this->logo->store('site-identity', 'public');
        }

        $faviconPath = $this->existingFavicon;
        if ($this->favicon) {
            if ($this->existingFavicon && Storage::disk('public')->exists($this->existingFavicon)) {
                Storage::disk('public')->delete($this->existingFavicon);
            }
            $faviconPath = $this->favicon->store('site-identity', 'public');
        }

        SiteIdentity::updateOrCreate(
            ['id' => $identity->id ?? 1],
            [
                'nama_website' => $this->nama_website,
                'tagline' => $this->tagline,
                'deskripsi_singkat' => $this->deskripsi_singkat,
                'nomor_whatsapp' => $this->nomor_whatsapp,
                'email' => $this->email,
                'jam_operasional' => $this->jam_operasional,
                'alamat' => $this->alamat,
                'link_gmaps' => $this->link_gmaps,
                'link_instagram' => $this->link_instagram,
                'link_facebook' => $this->link_facebook,
                'link_tiktok' => $this->link_tiktok,
                'link_youtube' => $this->link_youtube,
                'logo' => $logoPath,
                'favicon' => $faviconPath,
            ]
        );

        $this->existingLogo = $logoPath;
        $this->existingFavicon = $faviconPath;
        $this->logo = null;
        $this->favicon = null;

        session()->flash('message', 'Identitas website berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.admin.site-identity.index');
    }
}