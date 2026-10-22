<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_produk' => 'Astrea',   'harga' => 7000000,  'qty' => 20,  'gambar' => 'astrea.webp'],
            ['nama_produk' => 'Soul-GT',  'harga' => 10000000, 'qty' => 333, 'gambar' => 'soul-gt.png'],
            ['nama_produk' => 'N-Max',    'harga' => 28000000, 'qty' => 200, 'gambar' => 'nmax.webp'],
        ];

        foreach ($data as $row) {
            Produk::firstOrCreate(['nama_produk' => $row['nama_produk']], $row);
        }
    }
}
