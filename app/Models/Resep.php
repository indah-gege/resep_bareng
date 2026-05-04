<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    protected $fillable = [
        'judul', 'kategori_id', 'deskripsi_singkat',
        'waktu_masak', 'jumlah_porsi', 'tingkat_kesulitan',
        'bahan_bahan', 'langkah_langkah', 'foto',
    ];

    protected $casts = [
        'bahan_bahan'    => 'array',
        'langkah_langkah' => 'array',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }

    public function rataRating(): float
    {
        return $this->ulasans()->avg('rating') ?? 0;
    }
}