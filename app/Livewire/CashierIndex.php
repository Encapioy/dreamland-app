<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVariant; // Pastikan ini ada
use App\Models\Order;
use App\Models\OrderItem;

class CashierIndex extends Component
{
    // Data Master
    public $products_food = [];
    public $products_drink = [];

    // Data Transaksi
    public $cart = [];
    public $queueNumber;

    // UPDATE: Tambahan Data Pemesan
    public $customerName = '';
    public $customerPhone = '';

    // Data Modal
    public $isModalOpen = false;
    public $selectedProduct = null;
    public $selectedVariantId = null;
    public $note = '';

    // History
    public $isHistoryOpen = false;
    public $orderHistory = [];

    public function mount()
    {
        $this->loadProducts();
    }

    public function loadProducts()
    {
        // Ambil produk beserta variannya
        // Kita tidak filter is_available produk induk lagi, tapi nanti cek varian
        $products = Product::with('variants')->get();

        $this->products_food = $products->where('type', 'food');
        $this->products_drink = $products->where('type', 'drink');
    }

    // --- LOGIC STOK VARIAN (BARU) ---
    public function toggleVariantStock($variantId)
    {
        $variant = ProductVariant::find($variantId);
        if ($variant) {
            $variant->is_available = !$variant->is_available;
            $variant->save();

            // Reload agar tampilan terupdate
            // Jika modal sedang terbuka, kita harus refresh data produk yang dipilih juga
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

        // Cari varian pertama yang AVAILABLE untuk dijadikan default
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

    // --- CART ---
    public function addToCart()
    {
        if (!$this->selectedVariantId)
            return;

        $variant = ProductVariant::find($this->selectedVariantId);

        // Cek lagi apakah stok tersedia (takutnya dimatikan saat modal terbuka)
        if (!$variant->is_available) {
            session()->flash('error_modal', 'Maaf, varian ini baru saja habis.');
            return;
        }

        $this->cart[] = [
            'variant_id' => $variant->id,
            'product_name' => $this->selectedProduct->name,
            'variant_name' => $variant->name,
            'price' => $variant->price,
            'quantity' => 1,
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

    // --- CHECKOUT (UPDATE) ---
    public function checkout()
    {
        $this->validate([
            // UPDATE: Tambahkan min:0 dan max:100
            'queueNumber' => 'required|numeric|min:0|max:100',
            'customerName' => 'required|string|min:3',
            'cart' => 'required|array|min:1',
        ]);

        $order = Order::create([
            'queue_number' => $this->queueNumber,
            'customer_name' => $this->customerName, // Simpan Nama
            'customer_phone' => $this->customerPhone, // Simpan HP
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

        // Reset Form Lengkap
        $this->reset(['cart', 'queueNumber', 'customerName', 'customerPhone']);
        session()->flash('message', 'Pesanan #' . $order->queue_number . ' Berhasil Disimpan!');
    }

    // --- HISTORY LOGIC (SAMA SEPERTI SEBELUMNYA) ---
    public function openHistory()
    {
        $this->orderHistory = Order::with(['items.variant.product'])->latest()->take(20)->get();
        $this->isHistoryOpen = true;
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

    public function render()
    {
        return view('livewire.cashier-index');
    }
}