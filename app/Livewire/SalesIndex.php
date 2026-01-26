<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class SalesIndex extends Component
{
    public function render()
    {
        // Ambil semua produk, urutkan biar rapi
        $products = Product::with('variants')->get();

        return view('livewire.sales-index', [
            'products_food' => $products->where('type', 'food'),
            'products_drink' => $products->where('type', 'drink'),
        ]);
    }
}