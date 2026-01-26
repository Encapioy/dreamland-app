<?php

use App\Livewire\CashierIndex;
use App\Livewire\KitchenIndex;
use App\Livewire\WaiterIndex;
use App\Livewire\SalesIndex;
use App\Livewire\Auth\Login;


Route::get('/login', Login::class)->name('login');

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Logout Route
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
});


// GROUP YANG DIPROTEKSI (Harus Login Dulu)
Route::middleware(['auth'])->group(function () {

    Route::get('/kasir', CashierIndex::class);
    Route::get('/dapur/{type}', KitchenIndex::class);
    Route::get('/waiter', WaiterIndex::class);
    Route::get('/sales', SalesIndex::class);

});