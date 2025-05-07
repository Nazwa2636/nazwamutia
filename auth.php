<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Auth\ConfirmPassword;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\VerifyEmail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', VerifyEmail::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::get('confirm-password', ConfirmPassword::class)
        ->name('password.confirm');
});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');

    "{{ resources->views->inventory.blade.php }}"

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"> {{-- Assuming you have a CSS file --}}
        <title>Manajemen Barang</title>
    </head>
    <body>
        <div class="container">
            <h1>Manajemen Barang</h1>
            
            <div>
                <input type="text" placeholder="Cari nama barang..." class="search-bar">
                <select class="category-selector">
                    <option value="">Semua Kategori</option>
                    {{-- Add categories here --}}
                </select>
                <button class="add-button">+ Tambah Barang</button>
            </div>
    
            <h2>Form Barang</h2>
            <form method="POST" action="{{ route('barang.store') }}">
                @csrf
                <div>
                    <input type="text" name="nama_barang" placeholder="Nama Barang" required>
                    <input type="number" name="harga" placeholder="Harga" required>
                    <select name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        {{-- Add category options here --}}
                    </select>
                    <textarea name="deskripsi" placeholder="Deskripsi"></textarea>
                    <button type="submit" class="save-button">Simpan</button>
                </div>
            </form>
    
            <h2>Daftar Barang</h2>
            <table class="barang-table">
                <thead>
                    <tr>
                        <th>NAMA</th>
                        <th>HARGA</th>
                        <th>DESKRIPSI</th>
                        <th>KATEGORI</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop through barang data here --}}
                    <tr>
                        <td>Rice Cooker</td>
                        <td>Rp 200.000</td>
                        <td>Rice cooker dengan sistem canggih</td>
                        <td>Elektronik</td>
                        <td>
                            <button class="edit-button">Edit</button>
                            <button class="delete-button">Hapus</button>
                        </td>
                    </tr>
                    {{-- End loop --}}
                </tbody>
            </table>
    
            <div class="pagination">
                {{-- Add pagination links here --}}
                <span>Menampilkan 1 - 10 dari 35 barang</span>
                <button class="previous-button">«</button>
                <button class="next-button">»</button>
            </div>
    
            <footer>
                <p>Fitur Halaman:</p>
                <ul>
                    <li>Menambahkan data barang</li>
                    {{-- Include more features here --}}
                </ul>
            </footer>
        </div>
    
        <script src="{{ asset('js/app.js') }}"></script> {{-- Assuming you have a JS file --}}
    </body>
    </html>