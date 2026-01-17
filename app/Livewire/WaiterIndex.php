<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderItem;

class WaiterIndex extends Component
{
    public function markAsServed($itemId)
    {
        $item = OrderItem::find($itemId);
        if ($item) {
            $item->update(['status' => 'served']);
        }
    }

    public function render()
    {
        // 1. Ambil item yang statusnya 'ready' (sudah dimasak chef)
        // 2. Load relasinya biar ringan
        // 3. Kelompokkan (Group) berdasarkan Nomor Antrian (queue_number)
        $groups = OrderItem::where('status', 'ready')
            ->with(['order', 'variant.product'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return $item->order->queue_number;
            });

        return view('livewire.waiter-index', [
            'groups' => $groups
        ]);
    }
}