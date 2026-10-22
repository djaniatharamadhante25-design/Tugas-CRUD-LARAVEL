{{-- Form dipakai bersama oleh create & edit. Variabel: $produk (boleh null), $tombol --}}
@if ($errors->any())
    <div class="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
    <label for="nama_produk">Nama Produk</label>
    <input type="text" id="nama_produk" name="nama_produk" placeholder="Contoh: Yamaha NMAX 155"
           value="{{ old('nama_produk', $produk->nama_produk ?? '') }}" required>
</div>

<div class="form-group">
    <label for="harga">Harga (Rp)</label>
    <input type="number" id="harga" name="harga" min="0" placeholder="Contoh: 28000000"
           value="{{ old('harga', $produk->harga ?? '') }}" required>
</div>

<div class="form-group">
    <label for="qty">Qty</label>
    <input type="number" id="qty" name="qty" min="0" placeholder="Jumlah stok"
           value="{{ old('qty', $produk->qty ?? '') }}" required>
</div>

<div class="form-group">
    <label for="gambar">Gambar Produk</label>
    @php $url = isset($produk) ? $produk->gambar_url : null; @endphp
    <img id="preview" class="preview {{ $url ? '' : 'hidden' }}" src="{{ $url }}" alt="Preview gambar">
    <input type="file" id="gambar" name="gambar" accept=".jpg,.jpeg,.png,.webp">
    <div class="hint">
        {{ isset($produk) ? 'Kosongkan jika tidak ingin mengganti gambar.' : 'Opsional.' }}
        Format JPG, PNG, WEBP. Maksimal 2 MB.
    </div>
</div>

<div class="form-actions">
    <button type="submit" class="btn btn-primary">{{ $tombol }}</button>
    <a href="{{ route('produk.index') }}" class="btn btn-light">Batal</a>
</div>

@push('scripts')
<script>
document.getElementById('gambar').addEventListener('change', function () {
    const img = document.getElementById('preview');
    if (this.files && this.files[0]) {
        img.src = URL.createObjectURL(this.files[0]);
        img.classList.remove('hidden');
    }
});
</script>
@endpush
