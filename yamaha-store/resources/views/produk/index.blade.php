@extends('layouts.app')

@section('title', 'Data Sepeda Motor')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="stats">
        <div class="stat">
            <div class="icon">📦</div>
            <div><div class="label">Total Produk</div><div class="value">{{ $produks->count() }}</div></div>
        </div>
        <div class="stat">
            <div class="icon">🧮</div>
            <div><div class="label">Total Stok</div><div class="value">{{ number_format($totalStok, 0, ',', '.') }}</div></div>
        </div>
    </div>

    <div class="card">
        <div class="card-head">
            <h2>Data Sepeda Motor</h2>
            <div class="tools">
                <input type="text" id="cari" class="search" placeholder="🔍 Cari nama produk...">
                <a href="{{ route('produk.create') }}" class="btn btn-primary">+ Tambah Data</a>
            </div>
        </div>

        <div class="table-wrap">
            <table id="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($produks as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @if ($produk->gambar_url)
                                <img src="{{ $produk->gambar_url }}" class="thumb" alt="{{ $produk->nama_produk }}">
                            @else
                                <div class="thumb-empty">🏍️</div>
                            @endif
                        </td>
                        <td><strong>{{ $produk->nama_produk }}</strong></td>
                        <td>{{ $produk->harga_rupiah }}</td>
                        <td>
                            <span class="badge {{ $produk->qty > 5 ? 'badge-ok' : 'badge-low' }}">
                                {{ $produk->qty }} unit
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('produk.edit', $produk) }}" class="btn btn-warning btn-sm">✏️ Ubah</a>
                                <form action="{{ route('produk.destroy', $produk) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin hapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">🗑️ Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="empty">Belum ada data. Klik "Tambah Data" untuk memulai.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="footer">&copy; {{ date('Y') }} Yamaha Store</div>
@endsection

@push('scripts')
<script>
document.getElementById('cari').addEventListener('input', function () {
    const kata = this.value.toLowerCase();
    document.querySelectorAll('#tabel tbody tr').forEach(function (tr) {
        tr.style.display = tr.textContent.toLowerCase().includes(kata) ? '' : 'none';
    });
});
</script>
@endpush
