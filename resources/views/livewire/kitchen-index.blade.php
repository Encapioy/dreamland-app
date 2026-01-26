<div wire:poll.5s
    class="min-h-screen bg-slate-950 font-sans text-slate-200 selection:bg-yellow-500 selection:text-black">

    <div class="sticky top-0 z-50 bg-slate-950/80 backdrop-blur-md border-b border-slate-800 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <div class="flex items-center gap-4">
                    <div
                        class="h-10 w-1 rounded-full {{ $type == 'food' ? 'bg-orange-500 shadow-[0_0_15px_rgba(249,115,22,0.5)]' : 'bg-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.5)]' }}">
                    </div>
                    <div>
                        <h1 class="text-2xl font-black tracking-tight text-white uppercase">
                            Dapur {{ $type == 'food' ? 'Makanan' : 'Minuman' }}
                        </h1>
                        <p class="text-xs font-mono text-slate-400 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                            {{ now()->format('l, d M Y • H:i:s') }}
                        </p>
                    </div>
                </div>

                <button wire:click="$toggle('showHistory')"
                    class="px-4 py-2 rounded-xl text-xs font-bold uppercase tracking-wider border transition-all
                    {{ $showHistory ? 'bg-slate-800 text-white border-slate-600' : 'bg-transparent text-slate-500 border-slate-800 hover:border-slate-600 hover:text-white' }}">
                    {{ $showHistory ? 'Tutup Riwayat' : 'Riwayat Selesai' }}
                </button>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="mb-8 flex gap-4 overflow-x-auto pb-4 custom-scrollbar">
            <div
                class="shrink-0 bg-slate-900 border border-slate-800 rounded-2xl p-4 flex flex-col justify-center min-w-[140px]">
                <span class="text-[10px] uppercase font-bold text-slate-500 tracking-wider">Total Hari Ini</span>
                <span class="text-3xl font-black text-white">{{ $stats->sum() }} <span
                        class="text-sm font-medium text-slate-600">Porsi</span></span>
            </div>

            @foreach($stats as $name => $count)
                <div
                    class="shrink-0 bg-slate-900/50 border border-slate-800 rounded-2xl p-4 min-w-[120px] flex flex-col justify-between">
                    <span class="text-xs font-bold text-slate-400 mb-1 truncate max-w-[150px]"
                        title="{{ $name }}">{{ $name }}</span>
                    <div class="flex items-end gap-1">
                        <span
                            class="text-2xl font-bold {{ $type == 'food' ? 'text-orange-400' : 'text-blue-400' }}">{{ $count }}</span>
                        <span class="text-[10px] text-slate-600 mb-1">x</span>
                    </div>
                </div>
            @endforeach
        </div>

        @if($showHistory)
            <div
                class="mb-8 bg-slate-900 rounded-3xl p-6 border border-slate-800 animate-in slide-in-from-top-5 duration-300">
                <h3 class="text-white font-bold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Baru Saja Selesai
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                    @foreach($history as $h)
                        <div class="flex justify-between items-center bg-slate-950 p-3 rounded-xl border border-slate-800/50">
                            <div>
                                <span class="text-xs font-bold text-slate-500 block">Antrian
                                    #{{ $h->order->queue_number }}</span>
                                <span class="text-sm font-bold text-slate-300">{{ $h->variant->product->name }}</span>
                                <span class="text-xs text-slate-600">({{ $h->variant->name }})</span>
                            </div>
                            <span class="text-xs font-mono text-slate-500">{{ $h->updated_at->format('H:i') }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($items as $item)
                @php
                    // Hitung durasi antri (Timer Warna-warni)
                    $diffInMinutes = $item->created_at->diffInMinutes(now());
                    $timerColor = $diffInMinutes > 15 ? 'bg-red-500/10 text-red-500 border-red-500/20' :
                        ($diffInMinutes > 10 ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20' : 'bg-slate-800 text-slate-400 border-slate-700');
                @endphp

                <div
                    class="group relative bg-slate-900 rounded-3xl border border-slate-800 overflow-hidden flex flex-col shadow-lg hover:shadow-2xl hover:border-slate-600 transition-all duration-300">

                    <div
                        class="absolute top-0 left-0 bottom-0 w-1.5 {{ $type == 'food' ? 'bg-gradient-to-b from-orange-500 to-red-600' : 'bg-gradient-to-b from-blue-400 to-indigo-600' }}">
                    </div>

                    <div class="p-5 pb-0 flex justify-between items-start pl-7">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-widest text-slate-500">Antrian /
                                Meja</span>
                            <span
                                class="block text-4xl font-black text-white tracking-tighter">#{{ $item->order->queue_number }}</span>
                        </div>
                        <div class="px-2 py-1 rounded-lg border text-xs font-bold font-mono {{ $timerColor }}">
                            {{ $item->created_at->diffForHumans(null, true, true) }}
                        </div>
                    </div>

                    <div class="p-5 pl-7 flex-1">
                        <div class="flex items-start gap-4 mb-2">
                            <span class="text-5xl font-black {{ $type == 'food' ? 'text-orange-500' : 'text-blue-500' }}">
                                {{ $item->quantity }}<span class="text-2xl opacity-50">x</span>
                            </span>
                            <div class="pt-1">
                                <h2 class="text-xl font-bold text-white leading-tight mb-1">
                                    {{ $item->variant->product->name }}
                                </h2>
                                <p class="text-sm font-medium text-slate-400 bg-slate-800 px-2 py-0.5 rounded w-max">
                                    {{ $item->variant->name }}
                                </p>
                            </div>
                        </div>

                        @if($item->note)
                            <div class="mt-4 bg-red-500/10 border border-red-500/20 rounded-xl p-3 animate-pulse">
                                <div class="flex items-center gap-2 mb-1">
                                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    <span class="text-xs font-bold text-red-500 uppercase tracking-wide">Catatan Khusus</span>
                                </div>
                                <p class="text-sm font-bold text-red-200">"{{ $item->note }}"</p>
                            </div>
                        @endif

                        @if($item->order->location)
                            <div class="mt-4 flex items-center gap-2 text-xs text-slate-500 font-bold uppercase tracking-wider">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $item->order->location }}
                            </div>
                        @endif
                    </div>

                    <button wire:click="markAsReady({{ $item->id }})"
                        class="w-full py-5 text-center font-black text-lg uppercase tracking-widest transition-all hover:brightness-110 active:brightness-90
                            {{ $type == 'food' ? 'bg-orange-600 text-white hover:bg-orange-500' : 'bg-blue-600 text-white hover:bg-blue-500' }}">
                        Selesai Masak
                    </button>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-32 text-slate-600">
                    <div class="w-24 h-24 bg-slate-900 rounded-full flex items-center justify-center mb-6 shadow-inner">
                        <svg class="w-10 h-10 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-700">Dapur Bersih!</h3>
                    <p class="text-slate-500 mt-2">Belum ada pesanan masuk.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>