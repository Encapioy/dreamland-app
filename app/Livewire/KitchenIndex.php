<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderItem;

class KitchenIndex extends Component
{
    public $type; // Akan diisi 'food' atau 'drink' dari URL

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
        // Ambil item yang statusnya 'queued'
        // Dan filter berdasarkan tipe produk induknya
        $items = OrderItem::where('status', 'queued')
            ->whereHas('variant.product', function ($query) {
                $query->where('type', $this->type);
            })
            ->with(['order', 'variant.product']) // Eager loading biar ringan
            ->orderBy('created_at', 'asc') // Yang lama di atas (FIFO)
            ->get();

        return view('livewire.kitchen-index', [
            'items' => $items
        ]);
    }
}