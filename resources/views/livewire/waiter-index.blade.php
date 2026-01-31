<div wire:poll.5s class="min-h-screen bg-slate-100 pb-32 font-sans">

    <div class="fixed top-0 left-0 right-0 bg-slate-900 text-white shadow-lg z-50 rounded-b-3xl">
        <div class="flex justify-between items-center px-6 py-4 max-w-2xl mx-auto">
            <div>
                <h1 class="text-lg font-black tracking-wider text-yellow-400">WAITER APP 🏃‍♂️</h1>
            </div>
            <div class="flex items-center gap-2">
                <span class="animate-pulse w-2 h-2 bg-green-500 rounded-full"></span>
                <span class="text-xs font-bold text-green-400">Live</span>
            </div>
        </div>
    </div>

    <div class="h-24"></div>

    <div class="max-w-xl mx-auto px-4 space-y-6">

        @if($activeTab == 'tasks')
            @forelse($groups as $queueNumber => $items)
                    @php
                $order = $items->first()->order;
                $category = $order->customer_category; // santri, walsan, guru

                // Color Coding berdasarkan Kategori
                $headerColor = match ($category) {
                    'guru' => 'bg-purple-600',
                    'walsan' => 'bg-blue-600',
                    default => 'bg-emerald-600', // santri
                };

                $badgeColor = match ($category) {
                    'guru' => 'bg-purple-100 text-purple-700',
                    'walsan' => 'bg-blue-100 text-blue-700',
                    default => 'bg-emerald-100 text-emerald-700',
                };
                    @endphp

                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden transform transition-all hover:scale-[1.01]">

                        <div class="{{ $headerColor }} p-5 text-white">
                            <div class="flex justify-between items-start">
                                <div>
                                    <span class="inline-block px-2 py-0.5 rounded-md bg-white/20 backdrop-blur-sm text-[10px] font-bold uppercase tracking-wider mb-2 border border-white/30">
                                        {{ $category }}
                                    </span>

                                    <h2 class="text-2xl font-black leading-tight mb-1">{{ $order->customer_name }}</h2>

                                    <div class="flex items-center text-white/90 text-sm font-medium">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $order->location }}
                                    </div>
                                </div>

                                <div class="bg-white/10 p-3 rounded-2xl backdrop-blur-sm border border-white/20 text-center min-w-[70px]">
                                    <span class="block text-[10px] uppercase opacity-80">Antrian</span>
                                    <span class="block text-4xl font-black">{{ $queueNumber }}</span>
                                </div>
                            </div>

                            @if($order->customer_phone)
                                @php
                                    // 1. Persiapan Data
                                    $rawPhone = $order->customer_phone;
                                    $waPhone = preg_replace('/^0/', '62', $rawPhone); // Format 628...

                                    $name = $order->customer_name;
                                    $loc = $order->location; // Bisa isi teks lokasi, atau null/kosong
                                    $cat = $order->customer_category; // santri, walsan, guru

                                    // 2. Tentukan Brand & Sapaan Awal
                                    // Default values
                                    $msg = "";

                                    // --- LOGIKA PESAN ---

                                    if ($cat == 'guru') {
                                        // === KATEGORI GURU (Alexandria Station) ===
                                        $brand = "Alexandria Station";
                                        if (!empty($loc)) {
                                            // Lokasi Ada
                                            $msg = "Assalamu'alaikum Ustadz/Ustadzah *$name*, mohon maaf mengganggu. Kami dari *$brand*. Pesanan Antum sudah siap. Apakah Antum masih berada di *$loc*? InsyaAllah segera kami antarkan ke sana. Syukron.";
                                        } else {
                                            // Lokasi Kosong
                                            $msg = "Assalamu'alaikum Ustadz/Ustadzah *$name*, mohon maaf mengganggu. Kami dari *$brand*. Pesanan Antum sudah siap. Mohon petunjuk posisi Antum saat ini berada di mana? Agar segera kami antarkan. Syukron.";
                                        }

                                    } elseif ($cat == 'walsan') {
                                        // === KATEGORI WALSAN (Alexandria Station) ===
                                        $brand = "Alexandria Station";
                                        if (!empty($loc)) {
                                            // Lokasi Ada
                                            $msg = "Assalamu'alaikum Bapak/Ibu *$name*. Kami dari *$brand*. Pesanan Anda sudah siap. Apakah Bapak/Ibu masih berada di *$loc*? Mohon konfirmasinya agar segera kami antarkan. Terima kasih.";
                                        } else {
                                            // Lokasi Kosong
                                            $msg = "Assalamu'alaikum Bapak/Ibu *$name*. Kami dari *$brand*. Pesanan Anda sudah siap. Mohon maaf, boleh diinfokan posisi Bapak/Ibu saat ini duduk di sebelah mana? Agar pesanan segera kami antarkan. Terima kasih.";
                                        }

                                    } else {
                                        // === KATEGORI SANTRI (Takis Station) ===
                                        $brand = "Takis Station";
                                        if (!empty($loc)) {
                                            // Lokasi Ada
                                            $msg = "Halo *$name*, pesananmu dari *$brand* sudah siap nih. Kamu masih stay di *$loc* kan? Konfirmasi ya, biar langsung kami antar ke sana. Makasih!";
                                        } else {
                                            // Lokasi Kosong
                                            $msg = "Halo *$name*, pesananmu dari *$brand* sudah siap nih. Posisi kamu lagi di mana ya? Tolong info lokasinya biar langsung kami antar. Makasih!";
                                        }
                                    }

                                    // 3. Encode URL agar karakter spasi dan enter terbaca di WA
                                    $waUrl = "https://wa.me/$waPhone?text=" . urlencode($msg);
                                @endphp

                                    <div class="mt-4 flex gap-2">
                                        <a href="{{ $waUrl }}" target="_blank"
                                           class="flex-1 bg-white text-gray-800 hover:bg-green-50 px-3 py-2 rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-sm transition active:scale-95">
                                            <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                            Chat WA
                                        </a>
                                        <button onclick="copyToClipboard('{{ $rawPhone }}')"
                                            class="bg-black/20 hover:bg-black/30 text-white px-3 py-2 rounded-xl text-xs font-bold transition active:scale-95" title="Salin Nomor">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                        </button>
                                    </div>
                            @endif
                        </div>

                        <div class="bg-white p-2">
                            <div class="px-4 py-2 flex justify-between items-center border-b border-gray-100">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Item Siap Diantar</span>
                                <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-lg text-xs font-bold">{{ $items->count() }} Item</span>
                            </div>

                            <div class="divide-y divide-gray-50">
                                @foreach($items as $item)
                                    <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition rounded-xl group">
                                        <div class="flex-1 pr-3">
                                            <div class="flex items-center gap-2 mb-1">
                                                <h3 class="font-bold text-gray-800 text-lg leading-tight">{{ $item->variant->product->name }}</h3>
                                                <span class="text-[10px] px-1.5 py-0.5 rounded font-bold uppercase {{ $item->variant->product->type == 'food' ? 'bg-orange-100 text-orange-600' : 'bg-sky-100 text-sky-600' }}">
                                                    {{ $item->variant->product->type == 'food' ? 'Makan' : 'Minum' }}
                                                </span>
                                            </div>
                                            <p class="text-sm font-medium text-slate-500">{{ $item->variant->name }}</p>

                                            @if($item->note)
                                                <div class="mt-2 inline-flex items-center gap-1 bg-red-50 text-red-600 px-2 py-1 rounded-lg text-xs font-bold">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                                    "{{ $item->note }}"
                                                </div>
                                            @endif
                                        </div>

                                        <button wire:click="markAsServed({{ $item->id }})"
                                            class="w-14 h-14 rounded-full bg-slate-100 text-slate-400 hover:bg-green-500 hover:text-white flex items-center justify-center shadow-sm transition-all active:scale-90 border-2 border-slate-200 hover:border-green-600 group-hover:border-green-200">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

            @empty
                <div class="flex flex-col items-center justify-center pt-24 text-center px-6">
                    <div class="bg-white p-6 rounded-full shadow-lg mb-6 animate-bounce">
                        <span class="text-6xl">😴</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800 mb-2">Semua Aman!</h3>
                    <p class="text-slate-500 max-w-xs mx-auto">Tidak ada pesanan yang perlu diantar saat ini. Istirahat dulu sambil ngopi ☕.</p>
                </div>
            @endforelse

        @else
            <div class="bg-white rounded-3xl shadow-lg p-4">
                <h3 class="font-bold text-gray-800 text-lg mb-4 px-2">Riwayat Pengantaran (Hari Ini)</h3>
                <div class="space-y-4">
                    @forelse($historyItems as $item)
                        <div class="flex justify-between items-center border-b border-gray-100 pb-3 last:border-0">
                            <div>
                                <span class="text-[10px] text-gray-400 font-bold uppercase">{{ $item->updated_at->format('H:i') }} •
                                    Antrian #{{ $item->order->queue_number }}</span>
                                <h4 class="font-bold text-gray-800">{{ $item->variant->product->name }}</h4>
                                <p class="text-xs text-gray-500">{{ $item->variant->name }} • {{ $item->order->customer_name }}</p>
                            </div>
                            <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-[10px] font-bold">SELESAI</span>
                        </div>
                    @empty
                        <p class="text-center text-gray-400 py-10">Belum ada riwayat hari ini.</p>
                    @endforelse
                </div>
            </div>
        @endif
    </div>

    <div class="fixed bottom-6 left-0 right-0 px-6">
        <div
            class="max-w-md mx-auto bg-white/90 backdrop-blur-md rounded-2xl shadow-2xl border border-gray-200 p-2 flex justify-between">
            <button wire:click="switchTab('tasks')"
                class="flex-1 py-3 rounded-xl font-bold text-sm transition-all {{ $activeTab == 'tasks' ? 'bg-slate-900 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-100' }}">
                📋 Tugas
            </button>
            <button wire:click="switchTab('history')"
                class="flex-1 py-3 rounded-xl font-bold text-sm transition-all {{ $activeTab == 'history' ? 'bg-slate-900 text-white shadow-lg' : 'text-gray-400 hover:bg-gray-100' }}">
                clock Riwayat
            </button>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Kita pakai alert bawaan aja biar ringan
            alert('Nomor berhasil disalin: ' + text);
        }, function(err) {
            console.error('Gagal menyalin: ', err);
        });
    }
</script>