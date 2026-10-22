@extends('layouts.app')

@section('title', 'Tambah Data Sepeda Motor')

@section('content')
<div class="card form-card">
    <h2>Tambah Data Sepeda Motor</h2>
    <p class="sub">Isi form di bawah untuk menambahkan produk baru.</p>

    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('produk._form', ['produk' => null, 'tombol' => '💾 Simpan'])
    </form>
</div>
@endsection
