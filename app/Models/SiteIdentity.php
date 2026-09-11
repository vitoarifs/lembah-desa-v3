<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteIdentity extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_website',
        'tagline',
        'deskripsi_singkat',
        'logo',
        'favicon',
        'nomor_whatsapp',
        'email',
        'jam_operasional',
        'alamat',
        'link_gmaps',
        'link_instagram',
        'link_facebook',
        'link_tiktok',
        'link_youtube',
    ];
}