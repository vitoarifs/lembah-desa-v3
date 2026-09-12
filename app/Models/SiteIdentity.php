<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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

    /**
     * Ambil data identitas dari cache atau database.
     */
    public static function getSettings()
    {
        return Cache::rememberForever('site_identity', function () {
            return self::first();
        });
    }

    /**
     * Hapus cache ketika data diubah.
     */
    public static function clearCache(): void
    {
        Cache::forget('site_identity');
    }
}