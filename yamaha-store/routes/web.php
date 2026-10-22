<?php

use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/produk');

// index, create, store, edit, update, destroy
Route::resource('produk', ProdukController::class)->except(['show']);
