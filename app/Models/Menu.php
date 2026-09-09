<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama',
        'slug',
        'harga',
        'foto',
        'deskripsi',
        'isi_paket',
    ];

    protected $casts = [
        'isi_paket' => 'array',
        'harga' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor untuk format Rupiah di Blade ($menu->formatted_harga)
    protected function formattedHarga(): Attribute
    {
        return Attribute::make(
            get: fn () => 'Rp ' . number_format($this->harga, 0, ',', '.')
        );
    }
}