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
            // Update status dan timestamp updated_at agar urutannya naik ke paling atas di history
            $item->update(['status' => 'served', 'updated_at' => now()]);
        }
    }

    public function render()
    {
        // 1. TAB TUGAS: Ambil Item yang BELUM diantar (Ready)
        // Dikelompokkan berdasarkan Nomor Antrian
        $groups = OrderItem::where('status', 'ready')
            ->with(['order', 'variant.product'])
            ->orderBy('created_at', 'asc') // FIFO (First In First Out)
            ->get()
            ->groupBy(function ($item) {
                return $item->order->queue_number;
            });

        // 2. TAB RIWAYAT: Ambil Item yang SUDAH diantar (Served)
        // UPDATE: Menghapus whereDate dan take() agar menampilkan SEMUA riwayat pengantaran (All Time)
        $historyItems = OrderItem::where('status', 'served')
            ->with(['order', 'variant.product'])
            ->orderBy('updated_at', 'desc') // Yang baru diantar paling atas
            ->get();

        return view('livewire.waiter-index', [
            'groups' => $groups,
            'historyItems' => $historyItems
        ]);
    }
}