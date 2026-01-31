<div class="flex flex-col lg:flex-row h-screen bg-slate-100 overflow-hidden font-sans text-slate-800">

    <div class="w-full lg:w-2/3 flex flex-col h-full border-r border-slate-200 order-2 lg:order-1 bg-slate-50">

        <div
            class="bg-white px-8 py-5 shadow-sm z-10 flex justify-between items-center shrink-0 border-b border-slate-200">
            <div>
                <h1 class="text-3xl font-black text-slate-800 tracking-tight flex items-center gap-2">
                    Takis Station <span class="text-2xl">🚀</span>
                </h1>
                <p class="text-sm text-slate-500 font-medium">Kasir System • {{ now()->format('d M Y') }}</p>
            </div>

            <div class="flex space-x-3">
                <button wire:click="openStats"
                    class="flex items-center gap-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 px-5 py-2.5 rounded-xl transition-all font-bold text-sm border border-indigo-200 shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                    <span>Laporan</span>
                </button>

                <button wire:click="openHistory"
                    class="flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 px-5 py-2.5 rounded-xl transition-all font-bold text-sm border border-slate-200 shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Riwayat</span>
                </button>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">

            <div class="mb-12">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-10 w-1.5 bg-orange-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl font-black text-slate-700 tracking-tight">MAKANAN / FOOD 🍔</h2>
                </div>

                <div class="grid grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products_food as $product)
                        @php
                            $colors = ['border-orange-500', 'border-red-500', 'border-yellow-500'];
                            $colorClass = $colors[$loop->index % count($colors)];
                        @endphp

                        <button wire:click="openModal({{ $product->id }})" wire:key="prod-{{ $product->id }}"
                            class="group relative flex flex-col justify-between w-full text-left p-6 rounded-3xl bg-white border-2 border-slate-200 shadow-md hover:shadow-xl hover:border-orange-200 transition-all duration-300 hover:-translate-y-1 h-full overflow-hidden">

                            <div
                                class="absolute left-0 top-0 bottom-0 w-1.5 {{ $colorClass }} group-hover:w-2 transition-all">
                            </div>

                            <div>
                                <h3
                                    class="font-bold text-xl text-slate-800 leading-tight mb-2 group-hover:text-orange-600 transition-colors pr-8">
                                    {{ $product->name }}
                                </h3>
                                <div class="inline-block bg-slate-100 px-3 py-1 rounded-lg">
                                    <p class="text-xs font-bold text-slate-500">
                                        Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="absolute bottom-5 right-5 bg-slate-50 p-3 rounded-full text-slate-300 group-hover:bg-orange-500 group-hover:text-white transition-all shadow-sm group-hover:shadow-lg group-hover:scale-110 border border-slate-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>

            <div class="pb-20 lg:pb-0">
                <div class="flex items-center gap-4 mb-6">
                    <div class="h-10 w-1.5 bg-blue-500 rounded-full shadow-sm"></div>
                    <h2 class="text-2xl font-black text-slate-700 tracking-tight">MINUMAN / DRINK 🥤</h2>
                </div>

                <div class="grid grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products_drink as $product)
                        @php
                            $colors = ['border-blue-500', 'border-cyan-500', 'border-indigo-500'];
                            $colorClass = $colors[$loop->index % count($colors)];
                        @endphp

                        <button wire:click="openModal({{ $product->id }})" wire:key="prod-{{ $product->id }}"
                            class="group relative flex flex-col justify-between w-full text-left p-6 rounded-3xl bg-white border-2 border-slate-200 shadow-md hover:shadow-xl hover:border-blue-200 transition-all duration-300 hover:-translate-y-1 h-full overflow-hidden">

                            <div
                                class="absolute left-0 top-0 bottom-0 w-1.5 {{ $colorClass }} group-hover:w-2 transition-all">
                            </div>

                            <div>
                                <h3
                                    class="font-bold text-xl text-slate-800 leading-tight mb-2 group-hover:text-blue-600 transition-colors pr-8">
                                    {{ $product->name }}
                                </h3>
                                <div class="inline-block bg-slate-100 px-3 py-1 rounded-lg">
                                    <p class="text-xs font-bold text-slate-500">
                                        Mulai Rp {{ number_format($product->variants->min('price'), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div
                                class="absolute bottom-5 right-5 bg-slate-50 p-3 rounded-full text-slate-300 group-hover:bg-blue-500 group-hover:text-white transition-all shadow-sm group-hover:shadow-lg group-hover:scale-110 border border-slate-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div
        class="w-full lg:w-1/3 flex flex-col bg-white h-auto lg:h-full shadow-2xl z-20 order-1 lg:order-2 border-l border-slate-200">

        <div class="p-6 border-b border-slate-200 bg-white">
            <h2 class="text-lg font-black text-slate-800 uppercase tracking-widest mb-4">Data Pesanan</h2>

            <div class="grid grid-cols-3 gap-2 mb-4">
                @foreach(['santri' => ['Santri 🎓', 'green'], 'walsan' => ['Walsan 👪', 'blue'], 'guru' => ['Guru 🕌', 'purple']] as $val => $label)
                    <label class="cursor-pointer group">
                        <input type="radio" wire:model.blur="customerCategory" value="{{ $val }}" class="hidden peer">
                        <div
                            class="py-2.5 px-1 text-center border-2 rounded-xl transition-all font-bold text-xs
                                border-slate-100 text-slate-400 group-hover:border-slate-300
                                peer-checked:bg-{{ $label[1] }}-500 peer-checked:text-white peer-checked:border-{{ $label[1] }}-600 peer-checked:shadow-md">
                            {{ $label[0] }}
                        </div>
                    </label>
                @endforeach
            </div>
            @error('customerCategory') <span class="text-xs text-red-500 font-bold">{{ $message }}</span> @enderror

            <div class="space-y-3">
                <div class="flex gap-3">
                    <input type="text" wire:model.blur="customerName"
                        class="w-1/2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition placeholder-slate-400"
                        placeholder="Nama Pemesan...">
                    <input type="text" wire:model.blur="customerLocation"
                        class="w-1/2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-bold text-slate-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition placeholder-slate-400"
                        placeholder="Lokasi (Meja/Tribun)...">
                </div>
                <div class="relative">
                    <span class="absolute left-3 top-2.5 text-slate-400"><svg class="w-5 h-5" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg></span>
                    <input type="number" wire:model.blur="customerPhone"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-sm font-medium text-slate-800 focus:ring-2 focus:ring-green-500 outline-none transition placeholder-slate-400"
                        placeholder="Nomor WhatsApp (Opsional)">
                </div>
                <div class="flex items-center gap-2 bg-yellow-50 border border-yellow-200 rounded-xl px-4 py-1">
                    <span class="text-xs font-bold text-yellow-700 uppercase tracking-wider">Antrian #</span>
                    <input type="number" wire:model.blur="queueNumber" min="0" max="100"
                        class="w-full bg-transparent text-2xl font-black text-slate-800 focus:outline-none text-right"
                        placeholder="00">
                </div>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto p-4 space-y-3 bg-slate-50">
            @if(count($cart) == 0)
                <div class="flex flex-col items-center justify-center h-full text-slate-300">
                    <svg class="w-16 h-16 mb-2 stroke-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z">
                        </path>
                    </svg>
                    <p class="text-sm font-medium">Keranjang Kosong</p>
                </div>
            @endif

            @foreach($cart as $index => $item)
                <div
                    class="group flex justify-between items-start bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:border-blue-200 transition-all">
                    <div class="flex-1 pr-2">
                        <h4 class="font-bold text-slate-800 text-sm leading-tight">{{ $item['product_name'] }}</h4>
                        <div class="flex items-center gap-2 mt-1">
                            <span
                                class="text-[10px] bg-blue-50 text-blue-600 px-2 py-0.5 rounded font-bold uppercase tracking-wider">{{ $item['variant_name'] }}</span>
                            <span class="text-xs font-bold text-slate-500">x{{ $item['quantity'] }}</span>
                        </div>
                        @if($item['note'])
                            <p class="text-[10px] text-red-500 italic mt-1 bg-red-50 inline-block px-1.5 py-0.5 rounded">
                                "{{ $item['note'] }}"</p>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-slate-800 text-sm">Rp
                            {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                        <button wire:click="removeFromCart({{ $index }})"
                            class="text-[10px] text-slate-400 hover:text-red-500 underline mt-1 transition">Hapus</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-6 bg-white border-t border-slate-200 shrink-0">
            <div class="flex justify-between items-end mb-4">
                <span class="text-slate-400 text-xs font-bold uppercase tracking-widest">Total Tagihan</span>
                <span class="font-black text-3xl text-slate-800">Rp
                    {{ number_format($this->totalPrice, 0, ',', '.') }}</span>
            </div>

            @if (session()->has('message'))
                <div
                    class="bg-green-100 text-green-700 px-3 py-2 rounded-lg mb-3 text-center text-xs font-bold animate-pulse border border-green-200">
                    {{ session('message') }}
                </div>
            @endif

            <button wire:click="checkout" wire:loading.attr="disabled"
                class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-2xl text-lg shadow-xl shadow-slate-200 transform transition active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed flex justify-center items-center gap-2"
                @if(count($cart) == 0) disabled @endif>
                <span wire:loading.remove>PROSES PESANAN 🚀</span>
                <span wire:loading>MENYIMPAN... ⏳</span>
            </button>
        </div>
    </div>

    @if($isModalOpen && $selectedProduct)
        <div
            class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-end sm:items-center justify-center z-50 p-4 transition-opacity">
            <div
                class="bg-white rounded-3xl shadow-2xl w-full max-w-lg overflow-hidden animate-in slide-in-from-bottom-10 sm:zoom-in-95 duration-200">

                <div class="bg-slate-50 p-6 border-b border-slate-100 flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-black text-slate-800">{{ $selectedProduct->name }}</h3>
                        <p class="text-sm text-slate-500 font-medium">Sesuaikan pesananmu</p>
                    </div>
                    <button wire:click="closeModal"
                        class="bg-white border border-slate-200 p-2 rounded-full text-slate-400 hover:bg-red-50 hover:text-red-500 hover:border-red-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <div class="p-6 overflow-y-auto max-h-[60vh] custom-scrollbar">

                    <div class="mb-8">
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-3 tracking-wider">Pilih
                            Varian</label>
                        <div class="space-y-3">
                            @foreach($selectedProduct->variants as $variant)
                                <div
                                    class="flex items-center justify-between p-3 border-2 rounded-2xl transition-all cursor-pointer group
                                        {{ $selectedVariantId == $variant->id ? 'border-blue-500 bg-blue-50/50 shadow-sm ring-1 ring-blue-500' : 'border-slate-100 hover:border-slate-300' }}
                                        {{ !$variant->is_available ? 'opacity-50 grayscale bg-slate-50 cursor-not-allowed' : '' }}">

                                    <label class="flex items-center flex-1 cursor-pointer">
                                        <div class="relative flex items-center justify-center w-6 h-6 mr-4">
                                            <input type="radio" wire:model="selectedVariantId" value="{{ $variant->id }}"
                                                class="peer appearance-none w-6 h-6 border-2 border-slate-300 rounded-full checked:border-blue-500 checked:bg-blue-500 transition-all"
                                                @if(!$variant->is_available) disabled @endif>
                                            <div
                                                class="absolute w-2.5 h-2.5 bg-white rounded-full opacity-0 peer-checked:opacity-100 transition-opacity">
                                            </div>
                                        </div>

                                        <div>
                                            <span class="block font-bold text-slate-800 text-base">
                                                {{ $variant->name }}
                                                @if(!$variant->is_available) <span
                                                    class="text-red-600 bg-red-100 text-[10px] px-1.5 py-0.5 rounded ml-2 font-bold">HABIS</span>
                                                @endif
                                            </span>
                                            <span class="text-sm font-bold text-slate-500">Rp
                                                {{ number_format($variant->price, 0, ',', '.') }}</span>
                                        </div>
                                    </label>

                                    <button wire:click="toggleVariantStock({{ $variant->id }})"
                                        class="ml-2 px-3 py-1.5 rounded-lg text-[10px] font-black tracking-wider transition shadow-sm border
                                            {{ $variant->is_available ? 'bg-green-100 text-green-700 border-green-200 hover:bg-red-100 hover:text-red-600' : 'bg-red-100 text-red-600 border-red-200 hover:bg-green-100 hover:text-green-700' }}">
                                        {{ $variant->is_available ? 'ON' : 'OFF' }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">

                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 tracking-wider">Jumlah
                                Porsi</label>
                            <div
                                class="flex items-center justify-between bg-slate-100 rounded-xl p-1.5 border border-slate-200 w-full">
                                <button wire:click="decrementQty"
                                    class="w-12 h-12 bg-white rounded-lg shadow-sm text-slate-600 hover:text-red-500 hover:bg-red-50 transition active:scale-95 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4">
                                        </path>
                                    </svg>
                                </button>

                                <input type="number" wire:model="quantity"
                                    class="w-full bg-transparent font-black text-3xl text-slate-800 text-center focus:outline-none appearance-none m-0"
                                    min="1">

                                <button wire:click="incrementQty"
                                    class="w-12 h-12 bg-white rounded-lg shadow-sm text-slate-600 hover:text-blue-500 hover:bg-blue-50 transition active:scale-95 flex items-center justify-center shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-2 tracking-wider">Catatan
                                (Opsional)</label>
                            <textarea wire:model.blur="note"
                                class="w-full bg-white border-2 border-slate-200 rounded-xl p-3 text-sm focus:border-blue-500 focus:ring-0 outline-none transition resize-none h-[62px]"
                                placeholder="Contoh: Pedas, tanpa es..."></textarea>
                        </div>
                    </div>
                </div>

                <div class="p-6 border-t border-slate-100 bg-slate-50">
                    <button wire:click="addToCart"
                        class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-4 rounded-2xl shadow-xl shadow-slate-300 transform transition active:scale-95 flex justify-center items-center gap-3">
                        <span class="uppercase tracking-widest text-sm">Masukan Keranjang</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if($isHistoryOpen)
        <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm flex items-center justify-center z-50 p-4">
            <div
                class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl h-[85vh] flex flex-col overflow-hidden animate-in zoom-in-95 duration-200">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center bg-white">
                    <div>
                        <h3 class="text-2xl font-black text-slate-800">Riwayat Transaksi</h3>
                        <p class="text-sm text-slate-500">Daftar pesanan hari ini</p>
                    </div>
                    <button wire:click="closeHistory"
                        class="bg-slate-100 hover:bg-red-100 hover:text-red-600 p-2 rounded-full transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                    </button>
                </div>

                <div class="flex-1 overflow-y-auto bg-slate-50 p-6 custom-scrollbar">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Jam</th>
                                    <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Pemesan</th>
                                    <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Detail</th>
                                    <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Total</th>
                                    <th class="p-4 text-xs font-bold text-slate-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($orderHistory as $history)
                                    <tr class="hover:bg-blue-50/50 transition">
                                        <td class="p-4 text-sm font-medium text-slate-500 align-top">
                                            {{ $history->created_at->format('H:i') }}</td>
                                        <td class="p-4 align-top">
                                            <div class="flex flex-col gap-1">
                                                <span
                                                    class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-slate-800 text-white w-max">#{{ $history->queue_number }}</span>
                                                <span class="font-bold text-slate-800">{{ $history->customer_name }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 align-top">
                                            <ul class="space-y-1">
                                                @foreach($history->items as $item)
                                                    <li class="text-sm text-slate-600"><span
                                                            class="font-bold text-slate-900">{{ $item->quantity }}x</span>
                                                        {{ $item->variant->product->name }} <span
                                                            class="text-slate-400 text-xs">({{ $item->variant->name }})</span></li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="p-4 align-top font-bold text-slate-800">Rp
                                            {{ number_format($history->items->sum(fn($i) => $i->quantity * $i->variant->price), 0, ',', '.') }}
                                        </td>
                                        <td class="p-4 align-top">
                                            @php $status = $this->getOrderStatus($history); @endphp
                                            <span
                                                class="px-2 py-1 rounded-full text-[10px] font-bold uppercase {{ $status == 'Selesai' ? 'bg-green-100 text-green-700' : ($status == 'Siap Diantar' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">{{ $status }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="p-4 border-t bg-white text-right">
                    <button wire:click="closeHistory"
                        class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-8 py-3 rounded-xl shadow-lg transition">Tutup</button>
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
                        class="bg-slate-100 hover:bg-red-100 hover:text-red-600 p-2 rounded-full"><svg class="w-6 h-6"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg></button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div
                        class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl p-6 text-white shadow-lg shadow-green-500/30">
                        <span class="block text-green-100 text-sm font-bold uppercase tracking-wider mb-1">Total
                            Pendapatan</span>
                        <span class="block text-3xl font-black">Rp
                            {{ number_format($statsData['omzet_all'], 0, ',', '.') }}</span>
                    </div>
                    <div class="bg-white border-2 border-slate-100 rounded-2xl p-6 shadow-sm">
                        <span class="block text-slate-400 text-sm font-bold uppercase tracking-wider mb-1">Total
                            Transaksi</span>
                        <div class="flex items-baseline gap-1">
                            <span
                                class="block text-3xl font-black text-slate-700">{{ number_format($statsData['total_orders_all'], 0, ',', '.') }}</span>
                            <span class="text-sm font-bold text-slate-400">Pesanan</span>
                        </div>
                    </div>
                    <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6">
                        <span class="block text-slate-400 text-xs font-bold uppercase mb-3">Status Item</span>
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm"><span class="text-slate-500">Antri</span><span
                                    class="font-bold text-red-500">{{ $statsData['queued'] }}</span></div>
                            <div class="flex justify-between text-sm"><span class="text-slate-500">Ready</span><span
                                    class="font-bold text-blue-500">{{ $statsData['ready'] }}</span></div>
                            <div class="flex justify-between text-sm"><span class="text-slate-500">Selesai</span><span
                                    class="font-bold text-green-500">{{ $statsData['served'] }}</span></div>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="font-bold text-slate-700 text-lg mb-4">🔥 Top Produk</h3>
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                        @foreach($statsData['top_products'] as $name => $qty)
                            <div class="bg-white border border-slate-100 p-4 rounded-xl shadow-sm">
                                <span class="block text-xs text-slate-400 font-bold uppercase truncate">{{ $name }}</span>
                                <span class="block text-2xl font-black text-slate-800">{{ $qty }} <span
                                        class="text-xs font-medium text-slate-400">Sold</span></span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>