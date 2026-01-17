<div class="flex h-screen bg-gray-100 overflow-hidden font-sans">

    <div class="w-2/3 flex flex-col h-full border-r border-gray-300">
        <div class="bg-white p-4 shadow-sm z-10 flex justify-between">
            <div>
            <h1 class="text-2xl font-bold text-gray-800">Takis Station Menu</h1>
            <p class="text-sm text-gray-500">Pilih menu untuk menambahkan ke pesanan</p>
            </div>

            <button wire:click="openHistory" class="text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded flex items-center gap-1 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat
            </button>
        </div>

        <div class="flex-1 overflow-y-auto p-4 custom-scrollbar">

            <div class="mb-8">
                <h2 class="text-xl font-bold text-gray-700 mb-4 border-l-4 border-orange-500 pl-3">MAKANAN / FOOD</h2>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($products_food as $product)
                    @php
    // Daftar warna border yang akan diputar
    $colors = [
        'border-red-400 hover:border-red-600 hover:bg-red-50',
        'border-green-400 hover:border-green-600 hover:bg-green-50',
        'border-yellow-400 hover:border-yellow-600 hover:bg-yellow-50',
        'border-purple-400 hover:border-purple-600 hover:bg-purple-50',
        'border-orange-400 hover:border-orange-600 hover:bg-orange-50',
    ];
    // Pilih warna berdasarkan urutan loop (Modulo)
    $colorClass = $colors[$loop->index % count($colors)];
@endphp
                        <button wire:click="openModal({{ $product->id }})"
    class="w-full text-left p-4 rounded-xl shadow-sm hover:shadow-md transition transform hover:-translate-y-1 border-l-8 {{ $colorClass }} bg-white border-gray-100">

    <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
    <p class="text-sm text-gray-500 mt-1">Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}</p>
</button>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-xl font-bold text-gray-700 mb-4 border-l-4 border-blue-500 pl-3">MINUMAN / DRINK</h2>
                <div class="grid grid-cols-3 gap-4">
                    @foreach($products_drink as $product)
                        @php
    // Daftar warna border yang akan diputar
    $colors = [
        'border-red-400 hover:border-red-600 hover:bg-red-50',
        'border-green-400 hover:border-green-600 hover:bg-green-50',
        'border-yellow-400 hover:border-yellow-600 hover:bg-yellow-50',
        'border-purple-400 hover:border-purple-600 hover:bg-purple-50',
        'border-orange-400 hover:border-orange-600 hover:bg-orange-50',
    ];
    // Pilih warna berdasarkan urutan loop (Modulo)
    $colorClass = $colors[$loop->index % count($colors)];
@endphp
                        <button wire:click="openModal({{ $product->id }})"
    class="w-full text-left p-4 rounded-xl shadow-sm hover:shadow-md transition transform hover:-translate-y-1 border-l-8 {{ $colorClass }} bg-white border-gray-100">

    <h3 class="font-bold text-lg text-gray-800">{{ $product->name }}</h3>
    <p class="text-sm text-gray-500 mt-1">Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}</p>
</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="w-1/3 flex flex-col bg-white h-full shadow-2xl z-20">

        <div class="p-4 bg-white border-b border-gray-200 space-y-3">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase">Nama Pemesan</label>
                <input type="text" wire:model="customerName" class="w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none py-1 font-bold text-gray-800" placeholder="Contoh: Budi">
                @error('customerName') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase">Nomor HP / WA</label>
                <input type="text" wire:model="customerPhone" class="w-full border-b-2 border-gray-300 focus:border-blue-500 outline-none py-1 text-gray-800" placeholder="0812...">
            </div>
        </div>

        <div class="p-6 bg-gray-50 border-b border-gray-200">
            <label class="block text-sm font-bold text-gray-700 mb-1">NOMOR ANTRIAN / MEJA</label>
            <input type="number" wire:model="queueNumber" min="0" max="100"
                class="w-full text-4xl font-bold text-center p-3 border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:outline-none"
                placeholder="00">
            @error('queueNumber') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-3">
            @if(count($cart) == 0)
                <div class="text-center text-gray-400 mt-10">
                    <p>Keranjang masih kosong</p>
                </div>
            @endif

            @foreach($cart as $index => $item)
                <div class="flex justify-between items-start bg-gray-50 p-3 rounded-lg border border-gray-200">
                    <div>
                        <h4 class="font-bold text-gray-800">{{ $item['product_name'] }}</h4>
                        <p class="text-sm text-blue-600">{{ $item['variant_name'] }}</p>
                        @if($item['note'])
                            <p class="text-xs text-red-500 italic mt-1">Note: "{{ $item['note'] }}"</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-gray-800">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        <button wire:click="removeFromCart({{ $index }})" class="text-xs text-red-500 hover:underline mt-2">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-6 bg-gray-800 text-white">
            <div class="flex justify-between items-center mb-4 text-xl">
                <span>Total:</span>
                <span class="font-bold text-2xl">Rp {{ number_format($this->totalPrice, 0, ',', '.') }}</span>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-500 text-white p-2 rounded mb-2 text-center text-sm">
                    {{ session('message') }}
                </div>
            @endif

            <button wire:click="checkout"
                class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-4 rounded-lg text-xl shadow-lg transform transition active:scale-95 disabled:opacity-50"
                @if(count($cart) == 0) disabled @endif>
                BAYAR & PROSES
            </button>
        </div>
    </div>

    @if($isModalOpen && $selectedProduct)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 m-4 transform transition-all">

            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">{{ $selectedProduct->name }}</h3>
                <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="mb-4 max-h-60 overflow-y-auto"> <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Varian:</label>
                <div class="space-y-2">
                    @foreach($selectedProduct->variants as $variant)
                        <div class="flex items-center justify-between p-2 border rounded-lg {{ $selectedVariantId == $variant->id ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">

                            <label class="flex items-center cursor-pointer flex-1 {{ !$variant->is_available ? 'opacity-50 cursor-not-allowed' : '' }}">
                                <input type="radio" wire:model="selectedVariantId" value="{{ $variant->id }}"
                                    class="h-4 w-4 text-blue-600"
                                    @if(!$variant->is_available) disabled @endif>

                                <div class="ml-3">
                                    <span class="block font-medium text-gray-900">
                                        {{ $variant->name }}
                                        @if(!$variant->is_available) <span class="text-red-600 text-xs font-bold">(HABIS)</span> @endif
                                    </span>
                                    <span class="text-xs text-gray-500">Rp {{ number_format($variant->price, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <button wire:click="toggleVariantStock({{ $variant->id }})"
                                class="ml-3 p-2 rounded-full shadow-sm text-xs font-bold transition
                                {{ $variant->is_available ? 'bg-green-100 text-green-700 hover:bg-red-100 hover:text-red-600' : 'bg-red-100 text-red-600 hover:bg-green-100 hover:text-green-700' }}">
                                {{ $variant->is_available ? 'ADA' : 'HABIS' }}
                            </button>

                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">Catatan Khusus (Opsional):</label>
                <textarea wire:model="note" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="2" placeholder="Contoh: Jangan pedas, Es sedikit..."></textarea>
            </div>

            <button wire:click="addToCart" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow">
                Masukan Keranjang
            </button>
        </div>
    </div>
    @endif

    @if($isHistoryOpen)
            <div class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl h-3/4 flex flex-col m-4">

                    <div class="p-4 border-b flex justify-between items-center bg-gray-100 rounded-t-2xl">
                        <h3 class="text-xl font-bold text-gray-800">Riwayat Transaksi Terakhir</h3>
                        <button wire:click="closeHistory" class="text-gray-500 hover:text-red-500 font-bold text-xl">&times;</button>
                    </div>

                    <div class="flex-1 overflow-y-auto p-4 bg-gray-50">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-gray-500 text-sm border-b-2 border-gray-200">
                                    <th class="p-3">Waktu</th>
                                    <th class="p-3">No. Antrian</th>
                                    <th class="p-3">Detail Pesanan</th>
                                    <th class="p-3">Total</th>
                                    <th class="p-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
            @foreach($orderHistory as $history)
                <tr class="bg-white hover:bg-blue-50 transition">
                    <td class="p-3 text-sm text-gray-600 align-top">
                        {{ $history->created_at->format('H:i') }}
                    </td>

                    <td class="p-3 align-top">
                        <div class="flex flex-col">
                            <span class="bg-gray-800 text-white font-bold px-2 py-1 rounded w-max mb-1">
                                #{{ $history->queue_number }}
                            </span>
                            <span class="font-bold text-gray-800">{{ $history->customer_name }}</span>
                            @if($history->customer_phone)
                                <span class="text-xs text-gray-500">{{ $history->customer_phone }}</span>
                            @endif
                        </div>
                    </td>

                    <td class="p-3 align-top">
                        <ul class="text-sm text-gray-700 list-disc pl-4">
                            @foreach($history->items as $item)
                                <li>
                                    <span class="font-bold">{{ $item->quantity }}x</span>
                                    {{ $item->variant->product->name }}
                                    <span class="text-xs text-gray-500">({{ $item->variant->name }})</span>
                                </li>
                            @endforeach
                        </ul>
                    </td>

                    <td class="p-3 align-top font-bold text-gray-800">
                        Rp {{ number_format($history->items->sum(fn($i) => $i->quantity * $i->variant->price), 0, ',', '.') }}
                    </td>

                    <td class="p-3 text-right align-top">
                        <button wire:click="cancelOrder({{ $history->id }})"
                            wire:confirm="Yakin batal?"
                            class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 py-1 rounded text-xs font-bold transition border border-red-200">
                            BATAL
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-t bg-white rounded-b-2xl text-right">
                        <button wire:click="closeHistory" class="bg-gray-800 text-white px-6 py-2 rounded-lg hover:bg-gray-700">Tutup</button>
                    </div>
                </div>
            </div>
    @endif

</div>