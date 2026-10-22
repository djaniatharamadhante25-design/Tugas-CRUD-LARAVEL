<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produks';

    protected $fillable = ['nama_produk', 'harga', 'qty', 'gambar'];

    protected $casts = [
        'harga' => 'integer',
        'qty'   => 'integer',
    ];

    /** URL gambar, atau null kalau tidak ada file-nya. */
    public function getGambarUrlAttribute(): ?string
    {
        if ($this->gambar && file_exists(public_path('uploads/' . $this->gambar))) {
            return asset('uploads/' . $this->gambar);
        }

        return null;
    }

    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
