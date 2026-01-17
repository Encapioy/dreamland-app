<div wire:poll.5s class="min-h-screen bg-gray-900 p-4 font-sans">

    <div class="mb-6 flex justify-between items-center text-white border-b border-gray-700 pb-4">
        <div>
            <h1 class="text-3xl font-bold uppercase tracking-wider">
                DAPUR {{ $type == 'food' ? 'MAKANAN 🍔' : 'MINUMAN 🥤' }}
            </h1>
            <p class="text-gray-400 text-sm">Menunggu pesanan masuk...</p>
        </div>
        <div class="bg-gray-800 px-4 py-2 rounded-lg">
            <span class="text-xs text-gray-500 block">JAM</span>
            <span class="text-xl font-mono">{{ now()->format('H:i') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($items as $item)
            <div
                class="bg-white rounded-xl overflow-hidden shadow-2xl transform transition hover:scale-105 border-l-8 {{ $type == 'food' ? 'border-orange-500' : 'border-blue-500' }}">

                <div class="bg-gray-100 p-4 flex justify-between items-center border-b border-gray-200">
                    <span class="text-gray-500 font-bold text-sm">MEJA / ANTRIAN</span>
                    <span class="text-4xl font-black text-gray-800">#{{ $item->order->queue_number }}</span>
                </div>

                <div class="p-6">
                    <h2 class="text-2xl font-bold text-gray-900 leading-tight mb-1">
                        {{ $item->variant->product->name }}
                    </h2>
                    <p class="text-lg text-blue-600 font-medium mb-4">
                        Varian: {{ $item->variant->name }}
                    </p>

                    <div class="flex items-center justify-between bg-gray-50 p-3 rounded-lg mb-4">
                        <span class="text-gray-500 font-bold">JUMLAH</span>
                        <span class="text-3xl font-bold text-gray-800">x{{ $item->quantity }}</span>
                    </div>

                    @if($item->note)
                        <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded-lg mb-4">
                            <p class="text-xs font-bold uppercase mb-1">⚠️ CATATAN KHUSUS:</p>
                            <p class="font-bold text-lg">"{{ $item->note }}"</p>
                        </div>
                    @endif

                    <div class="text-xs text-gray-400 text-center mb-4">
                        Masuk: {{ $item->created_at->diffForHumans() }}
                    </div>

                    <button wire:click="markAsReady({{ $item->id }})"
                        class="w-full py-4 rounded-lg font-bold text-xl shadow-lg transition
                            {{ $type == 'food' ? 'bg-orange-500 hover:bg-orange-600 text-white' : 'bg-blue-500 hover:bg-blue-600 text-white' }}">
                        SELESAI / READY
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full flex flex-col items-center justify-center h-96 text-gray-500">
                <svg class="w-24 h-24 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-2xl font-light">Belum ada pesanan baru...</p>
                <p class="text-sm mt-2">Santai dulu sejenak.</p>
            </div>
        @endforelse

    </div>
</div>