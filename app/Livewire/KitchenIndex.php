<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderItem;
use Carbon\Carbon;

class KitchenIndex extends Component
{
    public $type; // Akan diisi 'food' atau 'drink' dari URL
    public $showHistory = false;

    public function mount($type)
    {
        // Validasi agar URL tidak ngawur
        if (!in_array($type, ['food', 'drink'])) {
            abort(404);
        }
        $this->type = $type;
    }

    public function markAsReady($itemId)
    {
        $item = OrderItem::find($itemId);
        if ($item) {
            $item->update(['status' => 'ready']);
            // Opsional: Flash message jika perlu, tapi biasanya Chef butuh cepat hilang
        }
    }

    public function render()
    {
        // 1. Data Item Antri (Queued)
        $items = OrderItem::where('status', 'queued')
            ->whereHas('variant.product', function ($query) {
                $query->where('type', $this->type);
            })
            ->with(['order', 'variant.product'])
            ->orderBy('created_at', 'asc')
            ->get();

        // 2. Data Statistik Hari Ini (Untuk Monitor)
        // Hitung jumlah 'served' + 'ready' hari ini per varian
        $stats = OrderItem::whereDate('created_at', Carbon::today())
            ->whereHas('variant.product', function ($query) {
                $query->where('type', $this->type);
            })
            ->whereIn('status', ['ready', 'served']) // Yang sudah dimasak
            ->with('variant.product') // Eager load
            ->get()
            ->groupBy('variant.product.name') // Group by Nama Produk
            ->map(function ($row) {
                return $row->count(); // Hitung jumlahnya
            });

        // 3. Data Riwayat Selesai (5 terakhir aja biar gak penuh)
        $history = OrderItem::where('status', 'ready') // Atau served juga boleh
            ->whereHas('variant.product', function ($query) {
                $query->where('type', $this->type);
            })
            ->orderBy('updated_at', 'desc')
            ->take(10)
            ->with(['order', 'variant'])
            ->get();

        return view('livewire.kitchen-index', [
            'items' => $items,
            'stats' => $stats,
            'history' => $history
        ]);
    }
}