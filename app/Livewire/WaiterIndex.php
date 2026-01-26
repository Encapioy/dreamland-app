<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderItem;
use Carbon\Carbon;

class WaiterIndex extends Component
{

    public $activeTab = 'tasks';

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }
    public function markAsServed($itemId)
    {
        $item = OrderItem::find($itemId);
        if ($item) {
            $item->update(['status' => 'served', 'updated_at' => now()]);
        }
    }

    public function render()
    {
        // 1. Ambil Item yang BELUM diantar (Ready) -> Dikelompokkan
        $groups = OrderItem::where('status', 'ready')
            ->with(['order', 'variant.product'])
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy(function ($item) {
                return $item->order->queue_number;
            });

        // 2. Ambil Item yang SUDAH diantar (Served) -> List biasa, urut dari yang barusan diantar
        // Kita filter hari ini saja agar history tidak terlalu panjang membebani HP
        $historyItems = OrderItem::where('status', 'served')
            ->whereDate('updated_at', Carbon::today())
            ->with(['order', 'variant.product'])
            ->orderBy('updated_at', 'desc')
            ->take(50) // Ambil 50 terakhir aja biar ringan
            ->get();

        return view('livewire.waiter-index', [
            'groups' => $groups,
            'historyItems' => $historyItems
        ]);
    }
}