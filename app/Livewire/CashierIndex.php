<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CashierIndex extends Component
{
    // Data Master
    public $products_food = [];
    public $products_drink = [];

    // Data Transaksi
    public $cart = [];
    public $queueNumber;

    // Data Pemesan
    public $customerName = '';
    public $customerPhone = '';
    public $customerLocation = '';
    public $customerCategory = 'santri';

    // Data Modal
    public $isModalOpen = false;
    public $selectedProduct = null;
    public $selectedVariantId = null;
    public $note = '';
    public $quantity = 1;

    // History
    public $isHistoryOpen = false;
    public $orderHistory = [];

    // Statistik
    public $isStatsOpen = false;
    public $statsData = [];

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $products = Product::with('variants')->get();
        $this->products_food = $products->where('type', 'food');
        $this->products_drink = $products->where('type', 'drink');
    }

    // --- LOGIC STOK VARIAN ---
    public function toggleVariantStock($variantId)
    {
        $variant = ProductVariant::find($variantId);
        if ($variant) {
            $variant->is_available = !$variant->is_available;
            $variant->save();

            if ($this->selectedProduct && $this->selectedProduct->id == $variant->product_id) {
                $this->selectedProduct = Product::with('variants')->find($this->selectedProduct->id);
            }
            $this->loadProducts();
        }
    }

    // --- LOGIC MODAL ---
    public function openModal($productId)
    {
        $this->selectedProduct = Product::with('variants')->find($productId);
        $this->quantity = 1;

        $firstAvailableVariant = $this->selectedProduct->variants->where('is_available', true)->first();
        $this->selectedVariantId = $firstAvailableVariant ? $firstAvailableVariant->id : null;
        $this->note = '';
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->selectedProduct = null;
    }

    public function incrementQty()
    {
        $this->quantity++;
    }

    public function decrementQty()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    // --- CART ---
    public function addToCart()
    {
        if (!$this->selectedVariantId) return;

        $variant = ProductVariant::find($this->selectedVariantId);

        if (!$variant->is_available) {
            session()->flash('error_modal', 'Maaf, varian ini baru saja habis.');
            return;
        }

        $this->cart[] = [
            'variant_id' => $variant->id,
            'product_name' => $this->selectedProduct->name,
            'variant_name' => $variant->name,
            'price' => $variant->price,
            'quantity' => $this->quantity,
            'note' => $this->note,
        ];

        $this->closeModal();
    }

    public function removeFromCart($index)
    {
        unset($this->cart[$index]);
        $this->cart = array_values($this->cart);
    }

    public function getTotalPriceProperty()
    {
        return collect($this->cart)->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    // --- CHECKOUT ---
    public function checkout()
    {
        $this->validate([
            'queueNumber' => 'required|numeric|min:0|max:100',
            'customerName' => 'required|string|min:3',
            'cart' => 'required|array|min:1',
            'customerLocation' => 'nullable|string',
            'customerCategory' => 'required|in:santri,walsan,guru',
        ]);

        $order = Order::create([
            'queue_number' => $this->queueNumber,
            'customer_name' => $this->customerName,
            'customer_phone' => $this->customerPhone,
            'location' => $this->customerLocation,
            'customer_category' => $this->customerCategory,
            'status' => 'paid',
        ]);

        foreach ($this->cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item['variant_id'],
                'quantity' => $item['quantity'],
                'note' => $item['note'],
                'status' => 'queued',
            ]);
        }

        $this->reset(['cart', 'queueNumber', 'customerName', 'customerPhone', 'customerLocation', 'customerCategory']);
        $this->customerCategory = 'santri';
        session()->flash('message', 'Pesanan #' . $order->queue_number . ' Berhasil Disimpan!');
    }

    // --- HISTORY LOGIC (DIPERBAIKI: Mengambil SEMUA data) ---
    public function openHistory()
    {
        // UPDATE: Menghapus whereDate dan take() agar menampilkan semua riwayat
        $this->orderHistory = Order::with(['items.variant.product'])
            ->latest() // Urutkan dari yang terbaru
            ->get();   // Ambil SEMUA data

        $this->isHistoryOpen = true;
    }

    public function getOrderStatus($order)
    {
        $totalItems = $order->items->count();
        if ($totalItems == 0) return 'Kosong';

        $servedCount = $order->items->where('status', 'served')->count();
        $readyCount = $order->items->where('status', 'ready')->count();

        if ($servedCount == $totalItems) return 'Selesai';
        if ($readyCount + $servedCount == $totalItems) return 'Siap Diantar';
        if ($readyCount > 0 || $servedCount > 0) return 'Sedang Disiapkan';
        return 'Menunggu Dapur';
    }

    public function closeHistory()
    {
        $this->isHistoryOpen = false;
    }

    public function cancelOrder($orderId)
    {
        $order = Order::find($orderId);
        if ($order) {
            $order->delete();
            $this->openHistory();
        }
    }

    // --- LOGIC STATISTIK (DIPERBAIKI: Data Keseluruhan / All Time) ---
    public function openStats()
    {
        // 1. Total Pendapatan (Semua Waktu)
        $omzetAllTime = OrderItem::with('variant')
            ->get()
            ->sum(function ($item) {
                return $item->quantity * $item->variant->price;
            });

        // 2. Total Transaksi (Semua Waktu)
        $totalOrdersAllTime = Order::count();

        // 3. Counter Status Item (Semua Waktu - DIPERBAIKI)
        // Menghapus filter whereDate agar menghitung status dari semua order yang pernah masuk
        $statusCounts = OrderItem::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')
            ->toArray();

        // 4. Top Penjualan Produk (Semua Waktu - DIPERBAIKI)
        // Menghapus filter whereDate agar ranking berdasarkan total penjualan selamanya
        $topProducts = OrderItem::with('variant.product')
            ->get()
            ->groupBy('variant.product.name')
            ->map(function ($rows) {
                return $rows->sum('quantity');
            })
            ->sortDesc()
            ->take(10); // Tetap ambil Top 10 tertinggi

        $this->statsData = [
            'omzet_all' => $omzetAllTime,
            'total_orders_all' => $totalOrdersAllTime,
            'queued' => $statusCounts['queued'] ?? 0,
            'ready' => $statusCounts['ready'] ?? 0,
            'served' => $statusCounts['served'] ?? 0,
            'top_products' => $topProducts
        ];

        $this->isStatsOpen = true;
    }

    public function closeStats()
    {
        $this->isStatsOpen = false;
    }

    public function render()
    {
        return view('livewire.cashier-index');
    }
}