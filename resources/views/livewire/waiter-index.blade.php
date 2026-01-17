<div wire:poll.5s class="min-h-screen bg-gray-100 p-4 pb-20 font-sans">

    <div class="fixed top-0 left-0 right-0 bg-green-600 text-white p-4 shadow-md z-50">
        <div class="flex justify-between items-center max-w-2xl mx-auto">
            <h1 class="text-xl font-bold uppercase tracking-wider">
                WAITER / PENGANTAR 🏃‍♂️
            </h1>
            <span class="text-sm bg-green-700 px-2 py-1 rounded">
                Live Update
            </span>
        </div>
    </div>

    <div class="h-16"></div>

    <div class="max-w-2xl mx-auto space-y-6">

        @forelse($groups as $queueNumber => $items)
            <div class="bg-white rounded-xl shadow-lg border-t-4 border-green-500 overflow-hidden">

                <div class="bg-gray-50 p-4 border-b border-gray-200 flex justify-between items-start">

    <div>
        <span class="text-xs text-gray-500 font-bold uppercase tracking-wide">ANTRIAN #{{ $queueNumber }}</span>

        <h2 class="text-2xl font-black text-gray-800 leading-none mt-1">
            {{ $items->first()->order->customer_name }}
        </h2>

        @if($items->first()->order->customer_phone)
    <div class="flex items-center mt-1 space-x-2">
        <div class="flex items-center text-gray-500 text-sm">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            <span id="phone-{{ $queueNumber }}">{{ $items->first()->order->customer_phone }}</span>
        </div>

        <button onclick="copyToClipboard('{{ $items->first()->order->customer_phone }}')"
            class="bg-blue-100 hover:bg-blue-200 text-blue-600 px-2 py-0.5 rounded text-xs font-bold border border-blue-200 transition"
            title="Salin Nomor">
            Salin
        </button>
    </div>
@endif
    </div>

    <div class="text-right bg-white px-3 py-2 rounded-lg border border-gray-200 shadow-sm">
        <span class="text-xs text-gray-400 block">Siap Diantar</span>
        <p class="font-bold text-green-600 text-xl leading-none">{{ $items->count() }}</p>
    </div>
</div>

                <div class="divide-y divide-gray-100">
                    @foreach($items as $item)
                        <div class="p-4 flex items-center justify-between hover:bg-gray-50 transition">
                            <div class="flex-1 pr-4">
                                <h3 class="font-bold text-gray-900 text-lg">
                                    {{ $item->variant->product->name }}
                                </h3>
                                <p class="text-sm text-blue-600">
                                    {{ $item->variant->name }}
                                </p>

                                <span
                                    class="inline-block mt-1 text-xs px-2 py-0.5 rounded
                                            {{ $item->variant->product->type == 'food' ? 'bg-orange-100 text-orange-600' : 'bg-blue-100 text-blue-600' }}">
                                    {{ $item->variant->product->type == 'food' ? '🍔 Makanan' : '🥤 Minuman' }}
                                </span>

                                @if($item->note)
                                    <p class="text-xs text-red-500 mt-1 italic">Note: "{{ $item->note }}"</p>
                                @endif
                            </div>

                            <button wire:click="markAsServed({{ $item->id }})"
                                class="bg-green-100 hover:bg-green-200 text-green-700 p-3 rounded-full shadow-sm transition transform active:scale-95 border border-green-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="flex flex-col items-center justify-center pt-20 text-gray-400">
                <svg class="w-20 h-20 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-lg font-medium">Semua pesanan sudah diantar!</p>
                <p class="text-sm">Silakan istirahat sejenak.</p>
            </div>
        @endforelse

    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Feedback sederhana (Alert)
            // Bisa diganti Toast kalau mau lebih keren, tapi ini paling cepat/ringan
            alert('Nomor WA berhasil disalin: ' + text);
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>