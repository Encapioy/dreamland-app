<div class="min-h-screen flex items-center justify-center bg-slate-900 p-4 font-sans">
    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">DREAMLAND</h1>
            <p class="text-slate-500">System Login</p>
        </div>

        <form wire:submit.prevent="login" class="space-y-6">

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Username</label>
                <input type="text" wire:model="username"
                    class="w-full border-2 border-slate-200 rounded-xl p-4 font-bold text-slate-800 focus:border-blue-500 focus:outline-none transition"
                    placeholder="masukkan role">
                @error('username') <span class="text-red-500 text-xs font-bold">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                <input type="password" wire:model="password"
                    class="w-full border-2 border-slate-200 rounded-xl p-4 font-bold text-slate-800 focus:border-blue-500 focus:outline-none transition"
                    placeholder="••••••">
            </div>

            <button type="submit"
                class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-4 rounded-xl shadow-lg transition transform active:scale-95">
                MASUK SISTEM 🚀
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-xs text-slate-400">Pastikan terhubung ke Wifi Lokal</p>
        </div>
    </div>
</div>