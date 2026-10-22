<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProdukController extends Controller
{
    /** Daftar produk + total produk & total stok. */
    public function index(): View
    {
        $produks    = Produk::orderByDesc('id')->get();
        $totalStok  = $produks->sum('qty');

        return view('produk.index', compact('produks', 'totalStok'));
    }

    public function create(): View
    {
        return view('produk.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->simpanGambar($request);
        }

        Produk::create($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk): View
    {
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, Produk $produk): RedirectResponse
    {
        $data = $this->validated($request);

        if ($request->hasFile('gambar')) {
            $this->hapusGambar($produk->gambar);          // buang gambar lama
            $data['gambar'] = $this->simpanGambar($request);
        }

        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        $this->hapusGambar($produk->gambar);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    // ---------------------------------------------------------------

    private function validated(Request $request): array
    {
        return $request->validate([
            'nama_produk' => ['required', 'string', 'max:255'],
            'harga'       => ['required', 'integer', 'min:0'],
            'qty'         => ['required', 'integer', 'min:0'],
            'gambar'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'required'     => ':attribute wajib diisi.',
            'integer'      => ':attribute harus berupa angka.',
            'min'          => ':attribute tidak boleh kurang dari :min.',
            'image'        => 'File yang dipilih bukan gambar yang valid.',
            'mimes'        => 'Format gambar harus JPG, PNG, atau WEBP.',
            'gambar.max'   => 'Ukuran gambar maksimal 2 MB.',
            'gambar.uploaded' => 'Upload gambar gagal. Coba lagi.',
        ], [
            'nama_produk' => 'Nama produk',
            'harga'       => 'Harga',
            'qty'         => 'Qty',
        ]);
    }

    private function simpanGambar(Request $request): string
    {
        $file = $request->file('gambar');
        $nama = 'motor_' . bin2hex(random_bytes(8)) . '.' . strtolower($file->getClientOriginalExtension());
        $file->move(public_path('uploads'), $nama);

        return $nama;
    }

    private function hapusGambar(?string $nama): void
    {
        // Gambar bawaan seeder tidak ikut dihapus dari disk agar aman di-reset.
        if ($nama && str_starts_with($nama, 'motor_')) {
            $path = public_path('uploads/' . $nama);
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }
}
