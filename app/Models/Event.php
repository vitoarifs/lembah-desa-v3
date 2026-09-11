<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'tanggal',
        'waktu',
        'lokasi',
        'htm',
        'deskripsi',
        // 'foto',
        'is_active',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Accessor untuk format tanggal Bahasa Indonesia (e.g. "Minggu, 18 Oktober 2026")
     */
    public function getFormattedTanggalAttribute(): string
    {
        return Carbon::parse($this->tanggal)->locale('id')->isoFormat('dddd, D MMMM Y');
    }
}