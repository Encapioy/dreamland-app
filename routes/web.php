<?php

use App\Livewire\CashierIndex;
use App\Livewire\KitchenIndex;
use App\Livewire\WaiterIndex;

Route::get('/', function () {
    return redirect('/kasir'); });
Route::get('/kasir', CashierIndex::class);
Route::get('/dapur/{type}', KitchenIndex::class);
Route::get('/waiter', WaiterIndex::class);