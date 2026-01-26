<div class="flex flex-col lg:flex-row h-screen bg-slate-100 overflow-hidden font-sans">

    <div class="w-full lg:w-2/3 flex flex-col h-full border-r border-gray-300 order-2 lg:order-1">

        <div class="bg-white px-6 py-4 shadow-sm z-10 flex justify-between items-center shrink-0">
            <div>
                <h1 class="text-2xl font-black text-gray-800 tracking-tight">Takis Station 🚀</h1>
                <p class="text-sm text-gray-500 font-medium">Kasir System</p>
            </div>

            <div class="flex space-x-6 lg:space-x-10">
            <button wire:click="openStats"
                class="group flex items-center gap-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-4 py-2 rounded-xl transition-all font-bold text-sm border border-indigo-200">
                <div class="bg-white p-1 rounded-md shadow-sm">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>
                <span>Statistik</span>
            </button>

            <button wire:click="openHistory" class="group flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 px-4 py-2 rounded-xl transition-all font-bold text-sm border border-slate-200">
                <div class="bg-white p-1 rounded-md shadow-sm group-hover:scale-110 transition">
                    <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <span>Riwayat</span>
            </button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-4 custom-scrollbar bg-slate-50">

            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <div class="h-8 w-1 bg-orange-500 rounded-full"></div>
                    <h2 class="text-xl font-bold text-gray-700">MAKANAN / FOOD 🍔</h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products_food as $product)
                        @php
    $colors = [
        'border-red-500 hover:bg-red-50',
        'border-blue-500 hover:bg-blue-50',
        'border-green-500 hover:bg-green-50',
        'border-yellow-500 hover:bg-yellow-50',
        'border-purple-500 hover:bg-purple-50',
        'border-orange-500 hover:bg-orange-50',
    ];
    $colorClass = $colors[$loop->index % count($colors)];
                        @endphp

                        <button wire:click="openModal({{ $product->id }})" wire:key="prod-{{ $product->id }}"
                            class="relative flex flex-col justify-between h-full w-full text-left p-4 rounded-2xl shadow-sm hover:shadow-lg transition-all transform hover:-translate-y-1 bg-white border-l-4 {{ $colorClass }}">

                            <div>
                                <h3 class="font-bold text-lg text-gray-800 leading-tight mb-1">{{ $product->name }}</h3>
                                <p class="text-xs font-semibold text-gray-400">Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}</p>
                            </div>

                            <div class="absolute bottom-3 right-3 bg-gray-100 p-1.5 rounded-full text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="pb-20 lg:pb-0"> <div class="flex items-center gap-3 mb-4">
                    <div class="h-8 w-1 bg-blue-500 rounded-full"></div>
                    <h2 class="text-xl font-bold text-gray-700">MINUMAN / DRINK 🥤</h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                    @foreach($products_drink as $product)
                        @php
    $colors = ['border-red-500 hover:bg-red-50', 'border-blue-500 hover:bg-blue-50', 'border-green-500 hover:bg-green-50', 'border-yellow-500 hover:bg-yellow-50', 'border-purple-500 hover:bg-purple-50', 'border-orange-500 hover:bg-orange-50'];
    $colorClass = $colors[$loop->index % count($colors)];
                        @endphp
                        <button wire:click="openModal({{ $product->id }})" wire:key="prod-{{ $product->id }}"
                            class="relative flex flex-col justify-between h-full w-full text-left p-4 rounded-2xl shadow-sm hover:shadow-lg transition-all transform hover:-translate-y-1 bg-white border-l-4 {{ $colorClass }}">
                            <div>
                                <h3 class="font-bold text-lg text-gray-800 leading-tight mb-1">{{ $product->name }}</h3>
                                <p class="text-xs font-semibold text-gray-400">Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}</p>
                            </div>
                            <div class="absolute bottom-3 right-3 bg-gray-100 p-1.5 rounded-full text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-1/3 flex flex-col bg-white h-auto lg:h-full shadow-2xl z-20 order-1 lg:order-2 border-l border-gray-200">

        <div class="p-5 bg-white border-b border-gray-200 space-y-4 shrink-0">

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Kategori Pemesan</label>
                <div class="grid grid-cols-3 gap-2">
                    <label class="cursor-pointer">
                        <input type="radio" wire:model.blur="customerCategory" value="santri" class="hidden peer">
                        <div class="py-2 px-1 text-center border-2 rounded-xl peer-checked:bg-green-500 peer-checked:text-white peer-checked:border-green-600 text-gray-500 border-gray-100 bg-gray-50 font-bold text-xs transition-all hover:bg-gray-100">
                            Santri 🎓
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model.blur="customerCategory" value="walsan" class="hidden peer">
                        <div class="py-2 px-1 text-center border-2 rounded-xl peer-checked:bg-blue-500 peer-checked:text-white peer-checked:border-blue-600 text-gray-500 border-gray-100 bg-gray-50 font-bold text-xs transition-all hover:bg-gray-100">
                            Walsan 👨‍👩‍👧
                        </div>
                    </label>
                    <label class="cursor-pointer">
                        <input type="radio" wire:model.blur="customerCategory" value="guru" class="hidden peer">
                        <div class="py-2 px-1 text-center border-2 rounded-xl peer-checked:bg-purple-500 peer-checked:text-white peer-checked:border-purple-600 text-gray-500 border-gray-100 bg-gray-50 font-bold text-xs transition-all hover:bg-gray-100">
                            Guru 🕌
                        </div>
                    </label>
                </div>
                @error('customerCategory') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Nama</label>
                    <input type="text" wire:model.blur="customerName"
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="Nama...">
                    @error('customerName') <span class="text-xs text-red-500 font-bold block">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Lokasi</label>
                    <input type="text" wire:model.blur="customerLocation"
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg px-3 py-2 text-sm font-bold text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                        placeholder="Meja/Tribun...">
                    @error('customerLocation') <span class="text-xs text-red-500 font-bold block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">WhatsApp (Opsional)</label>
                <div class="relative">
                    <span class="absolute left-3 top-2 text-gray-400 text-sm"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg></span>
                    <input type="number" wire:model.blur="customerPhone"
                        class="w-full bg-gray-50 border border-gray-200 rounded-lg pl-9 pr-3 py-2 text-sm text-gray-800 focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none transition"
                        placeholder="0812...">
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-white">
            <div class="flex items-center justify-between mb-4 bg-yellow-50 p-3 rounded-xl border border-yellow-200">
                <span class="text-xs font-bold text-yellow-700 uppercase">Antrian #</span>
                <input type="number" wire:model.blur="queueNumber" min="0" max="100"
                    class="w-20 text-center text-2xl font-black bg-transparent border-b-2 border-yellow-500 focus:outline-none text-gray-800"
                    placeholder="00">
            </div>
             @error('queueNumber') <span class="text-red-500 text-xs font-bold text-center block mb-2">{{ $message }}</span> @enderror

            @if(count($cart) == 0)
                <div class="flex flex-col items-center justify-center h-40 text-gray-300">
                    <svg class="w-16 h-16 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                    <p class="text-sm font-medium">Keranjang Kosong</p>
                </div>
            @endif

            @foreach($cart as $index => $item)
                <div class="group relative flex justify-between items-start bg-white hover:bg-gray-50 p-3 rounded-xl border border-gray-100 shadow-sm transition-all">
                    <div class="flex-1 pr-2">
                        <h4 class="font-bold text-gray-800 text-sm leading-tight">{{ $item['product_name'] }}</h4>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs bg-blue-50 text-blue-600 px-2 py-0.5 rounded font-bold">{{ $item['variant_name'] }}</span>
                            <span class="text-xs font-bold text-gray-500">x{{ $item['quantity'] }}</span>
                        </div>
                        @if($item['note'])
                            <p class="text-[10px] text-red-500 italic mt-1 bg-red-50 inline-block px-1 rounded">"{{ $item['note'] }}"</p>
                        @endif
                    </div>

                    <div class="text-right">
                        <p class="font-bold text-gray-800 text-sm">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        <button wire:click="removeFromCart({{ $index }})" class="text-[10px] text-gray-400 hover:text-red-500 underline mt-1 transition">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-5 bg-slate-900 text-white shrink-0 rounded-t-3xl lg:rounded-none">
            <div class="flex justify-between items-end mb-4">
                <span class="text-gray-400 text-sm">Total Tagihan</span>
                <span class="font-bold text-3xl">Rp {{ number_format($this->totalPrice, 0, ',', '.') }}</span>
            </div>

            @if (session()->has('message'))
                <div class="bg-green-500/20 border border-green-500 text-green-400 px-3 py-2 rounded-lg mb-3 text-center text-xs font-bold animate-pulse">
                    {{ session('message') }}
                </div>
            @endif

            <button wire:click="checkout" wire:loading.attr="disabled"
                class="w-full bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white font-bold py-4 rounded-2xl text-lg shadow-lg shadow-green-900/50 transform transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed flex justify-center items-center gap-2"
                @if(count($cart) == 0) disabled @endif>

                <span wire:loading.remove>PROSES PESANAN 🚀</span>
                <span wire:loading>MENYIMPAN... ⏳</span>
            </button>
        </div>
    </div>

    @if($isModalOpen && $selectedProduct)
    <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm flex items-end sm:items-center justify-center z-50 p-4">
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-6 transform transition-all animate-in slide-in-from-bottom-10 sm:slide-in-from-bottom-0 sm:zoom-in-95 duration-200">

            <div class="flex justify-between items-start mb-6 border-b border-gray-100 pb-4">
                <div>
                    <h3 class="text-2xl font-black text-gray-800">{{ $selectedProduct->name }}</h3>
                    <p class="text-sm text-gray-500">Pilih varian rasa & detail</p>
                </div>
                <button wire:click="closeModal" class="bg-gray-100 p-2 rounded-full text-gray-500 hover:bg-red-100 hover:text-red-500 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="mb-6 max-h-[40vh] overflow-y-auto pr-2 custom-scrollbar">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-3">Varian Tersedia</label>
                <div class="space-y-3">
                    @foreach($selectedProduct->variants as $variant)
                        <div class="flex items-center justify-between p-3 border-2 rounded-xl transition-all cursor-pointer group
                            {{ $selectedVariantId == $variant->id ? 'border-blue-500 bg-blue-50/50' : 'border-gray-100 hover:border-gray-200' }}
                            {{ !$variant->is_available ? 'opacity-60 grayscale' : '' }}">

                            <label class="flex items-center flex-1 cursor-pointer">
                                <div class="relative flex items-center justify-center w-5 h-5 mr-3">
                                    <input type="radio" wire:model="selectedVariantId" value="{{ $variant->id }}"
                                        class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-full checked:border-blue-500 checked:bg-blue-500 transition-all"
                                        @if(!$variant->is_available) disabled @endif>
                                    <div class="absolute w-2 h-2 bg-white rounded-full opacity-0 peer-checked:opacity-100"></div>
                                </div>

                                <div>
                                    <span class="block font-bold text-gray-800 text-sm">
                                        {{ $variant->name }}
                                        @if(!$variant->is_available) <span class="text-red-500 text-[10px] ml-1 bg-red-100 px-1 rounded">HABIS</span> @endif
                                    </span>
                                    <span class="text-xs font-semibold text-gray-500">Rp {{ number_format($variant->price, 0, ',', '.') }}</span>
                                </div>
                            </label>

                            <button wire:click="toggleVariantStock({{ $variant->id }})"
                                class="ml-2 px-3 py-1.5 rounded-lg text-[10px] font-black tracking-wider transition shadow-sm
                                {{ $variant->is_available ? 'bg-green-100 text-green-700 hover:bg-red-100 hover:text-red-600' : 'bg-red-100 text-red-600 hover:bg-green-100 hover:text-green-700' }}">
                                {{ $variant->is_available ? 'ON' : 'OFF' }}
                            </button>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-400 uppercase mb-2">Catatan (Opsional)</label>
                <textarea wire:model.blur="note" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition resize-none" rows="2" placeholder="Contoh: Jangan pedas, Es sedikit..."></textarea>
            </div>

            <button wire:click="addToCart" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-blue-500/30 transform transition active:scale-95">
                + MASUKKAN KERANJANG
            </button>
        </div>
    </div>
    @endif

    @if($isHistoryOpen)
        <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col overflow-hidden animate-in zoom-in-95 duration-200">

                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-white">
                    <div>
                        <h3 class="text-2xl font-black text-gray-800">Riwayat Transaksi</h3>
                        <p class="text-sm text-gray-500">Daftar pesanan hari ini</p>
                    </div>
                    <button wire:click="closeHistory" class="bg-gray-100 hover:bg-red-100 hover:text-red-600 p-2 rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto bg-slate-50 p-6 custom-scrollbar">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Jam</th>
                                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Pemesan</th>
                                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Detail Item</th>
                                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Total</th>
                                    <th class="p-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($orderHistory as $history)
                                                    <tr class="hover:bg-blue-50/50 transition">
                                                        <td class="p-4 text-sm font-medium text-gray-500 align-top">
                                                            {{ $history->created_at->format('H:i') }}
                                                        </td>
                                                        <td class="p-4 align-top">
                                                            <div class="flex flex-col gap-1">
                                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-gray-800 text-white w-max">
                                                                    #{{ $history->queue_number }}
                                                                </span>
                                                                <span class="font-bold text-gray-800">{{ $history->customer_name }}</span>
                                                                <div class="flex gap-2">
                                                                    <span class="text-[10px] font-bold uppercase px-1.5 py-0.5 rounded
                                                                        {{ $history->customer_category == 'guru' ? 'bg-purple-100 text-purple-700' :
            ($history->customer_category == 'walsan' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">
                                                                        {{ $history->customer_category }}
                                                                    </span>
                                                                    @if($history->location)
                                                                        <span class="text-[10px] font-bold text-gray-500 bg-gray-100 px-1.5 py-0.5 rounded flex items-center">
                                                                            📍 {{ $history->location }}
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 align-top">
                                                            <ul class="space-y-1">
                                                                @foreach($history->items as $item)
                                                                    <li class="text-sm text-gray-600">
                                                                        <span class="font-bold text-gray-900">{{ $item->quantity }}x</span>
                                                                        {{ $item->variant->product->name }}
                                                                        <span class="text-gray-400 text-xs">({{ $item->variant->name }})</span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </td>
                                                        <td class="p-4 align-top font-bold text-gray-800">
                                                            Rp {{ number_format($history->items->sum(fn($i) => $i->quantity * $i->variant->price), 0, ',', '.') }}
                                                        </td>
                                                        <td class="p-4 align-top">
                                                            @php $status = $this->getOrderStatus($history); @endphp
                                                            <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase
                                                                {{ $status == 'Selesai' ? 'bg-green-100 text-green-700' :
            ($status == 'Siap Diantar' ? 'bg-blue-100 text-blue-700' :
                ($status == 'Sedang Disiapkan' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-500')) }}">
                                                                {{ $status }}
                                                            </span>
                                                        </td>
                                                        {{-- <td class="p-4 text-right align-top">
                                                            <button wire:click="cancelOrder({{ $history->id }})"
                                                                wire:confirm="Yakin ingin membatalkan/menghapus pesanan ini? Data akan hilang dari dapur."
                                                                class="bg-white border border-red-200 text-red-500 hover:bg-red-500 hover:text-white px-3 py-1.5 rounded-lg text-xs font-bold transition shadow-sm">
                                                                BATALKAN
                                                            </button>
                                                        </td> --}}
                                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="p-4 border-t bg-white text-right">
                    <button wire:click="closeHistory" class="bg-gray-800 hover:bg-gray-900 text-white font-bold px-8 py-3 rounded-xl shadow-lg transition">Tutup</button>
                </div>
            </div>
        </div>
    @endif

    @if($isStatsOpen)
        <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-4xl p-8 animate-in zoom-in-95">

                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-3xl font-black text-slate-800">Laporan Statistik 📈</h2>
                    <button wire:click="closeStats"
                        class="bg-gray-100 hover:bg-red-100 hover:text-red-600 p-2 rounded-full"><svg class="w-6 h-6"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg></button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div
                        class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg shadow-green-500/30">
                        <span class="block text-green-100 text-sm font-bold uppercase tracking-wider mb-1">Total Pendapatan</span>
                        <span class="block text-3xl font-black">Rp
                            {{ number_format($statsData['omzet_all'], 0, ',', '.') }}</span>
                    </div>

                    <div class="bg-white border-2 border-slate-100 rounded-2xl p-6 shadow-sm">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">
                            Total Transaksi
                        </span>
                        <div class="flex items-baseline gap-1">
                            <span class="block text-3xl font-black text-slate-700">
                                {{ number_format($statsData['total_orders_all'], 0, ',', '.') }}
                            </span>
                            <span class="text-sm font-bold text-slate-400">Pesanan</span>
                        </div>
                    </div>

                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6">
                        <span class="block text-slate-400 text-xs font-bold uppercase mb-3">Status Item</span>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Antri Masak (Queued)</span>
                                <span class="font-bold text-red-500">{{ $statsData['queued'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Siap Diantar (Ready)</span>
                                <span class="font-bold text-blue-500">{{ $statsData['ready'] }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Selesai (Served)</span>
                                <span class="font-bold text-green-500">{{ $statsData['served'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-slate-700 text-lg mb-4">🔥 Top Produk Terlaris (Hari Ini)</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @foreach($statsData['top_products'] as $name => $qty)
                            <div class="bg-white border border-gray-100 p-4 rounded-xl shadow-sm">
                                <span class="block text-xs text-gray-400 font-bold uppercase truncate">{{ $name }}</span>
                                <span class="block text-2xl font-black text-slate-800">{{ $qty }} <span
                                        class="text-xs font-medium text-gray-400">Sold</span></span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    @endif

</div>