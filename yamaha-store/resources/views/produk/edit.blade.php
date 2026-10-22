@extends('layouts.app')

@section('title', 'Ubah Data Sepeda Motor')

@section('content')
<div class="card form-card">
    <h2>Ubah Data Sepeda Motor</h2>
    <p class="sub">Perbarui informasi produk lalu klik Update.</p>

    <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('produk._form', ['produk' => $produk, 'tombol' => '✅ Update'])
    </form>
</div>
@endsection
