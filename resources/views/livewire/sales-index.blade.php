<div wire:poll.10s class="min-h-screen bg-slate-100 p-4 font-sans pb-20">
    <div class="bg-white p-4 rounded-xl shadow-sm mb-6 border border-slate-200 sticky top-4 z-10">
        <h1 class="text-xl font-black text-slate-800 uppercase">Monitor Stok Sales 🕵️</h1>
        <p class="text-xs text-slate-500">Update otomatis setiap 10 detik</p>
    </div>

    <div class="space-y-8">

        <div>
            <h2 class="text-lg font-bold text-orange-600 mb-3 flex items-center gap-2">
                🍔 STOK MAKANAN
            </h2>
            <div class="grid grid-cols-1 gap-3">
                @foreach($products_food as $product)
                    <div
                        class="bg-white p-4 rounded-xl border-l-4 shadow-sm {{ $product->variants->where('is_available', true)->count() > 0 ? 'border-green-500' : 'border-red-500 bg-red-50' }}">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-slate-800 text-lg">{{ $product->name }}</h3>
                            @if($product->variants->where('is_available', true)->count() == 0)
                                <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">HABIS TOTAL</span>
                            @endif
                        </div>

                        <div class="space-y-1">
                            @foreach($product->variants as $variant)
                                <div
                                    class="flex justify-between items-center text-sm border-b border-dashed border-slate-100 pb-1 last:border-0">
                                    <span class="text-slate-600">{{ $variant->name }}</span>
                                    @if($variant->is_available)
                                        <span class="text-green-600 font-bold text-xs flex items-center gap-1">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span> ADA
                                        </span>
                                    @else
                                        <span class="text-red-500 font-bold text-xs flex items-center gap-1">
                                            <span class="w-2 h-2 rounded-full bg-red-500"></span> HABIS
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div>
            <h2 class="text-lg font-bold text-blue-600 mb-3 flex items-center gap-2">
                🥤 STOK MINUMAN
            </h2>
            <div class="grid grid-cols-1 gap-3">
                @foreach($products_drink as $product)
                    <div
                        class="bg-white p-4 rounded-xl border-l-4 shadow-sm {{ $product->variants->where('is_available', true)->count() > 0 ? 'border-green-500' : 'border-red-500 bg-red-50' }}">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="font-bold text-slate-800 text-lg">{{ $product->name }}</h3>
                            @if($product->variants->where('is_available', true)->count() == 0)
                                <span class="bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded">HABIS TOTAL</span>
                            @endif
                        </div>
                        <div class="space-y-1">
                            @foreach($product->variants as $variant)
                                <div
                                    class="flex justify-between items-center text-sm border-b border-dashed border-slate-100 pb-1 last:border-0">
                                    <span class="text-slate-600">{{ $variant->name }}</span>
                                    @if($variant->is_available)
                                        <span class="text-green-600 font-bold text-xs flex items-center gap-1">
                                            <span class="w-2 h-2 rounded-full bg-green-500"></span> ADA
                                        </span>
                                    @else
                                        <span class="text-red-500 font-bold text-xs flex items-center gap-1">
                                            <span class="w-2 h-2 rounded-full bg-red-500"></span> HABIS
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>