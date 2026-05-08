<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="font-black text-3xl text-slate-900 tracking-tight font-display">
                    {{ __('Suivi des Ventes') }}
                </h2>
                <p class="text-slate-500 font-medium mt-1">Consultez l'historique complet des transactions.</p>
            </div>
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                <div class="px-4 py-2 bg-indigo-50 rounded-xl text-center">
                    <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Total Ventes</div>
                    <div class="text-lg font-black text-indigo-700">{{ $orders->where('status', 'success')->count() }}</div>
                </div>
                <div class="px-4 py-2 bg-emerald-50 rounded-xl text-center">
                    <div class="text-[10px] font-black text-emerald-400 uppercase tracking-widest">Revenus</div>
                    <div class="text-lg font-black text-emerald-700">{{ number_format($orders->where('status', 'success')->sum('amount'), 0, '', ' ') }} <span class="text-[10px]">CFA</span></div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container-app">
            <div class="card-premium">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-[10px] text-slate-400 uppercase tracking-[0.2em]">
                                <th class="px-8 py-5 font-black">ID Commande</th>
                                <th class="px-8 py-5 font-black">Client</th>
                                <th class="px-8 py-5 font-black">Produit acheté</th>
                                <th class="px-8 py-5 font-black">Montant</th>
                                <th class="px-8 py-5 font-black">Statut</th>
                                <th class="px-8 py-5 font-black">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($orders as $order)
                                <tr class="group hover:bg-slate-50/50 transition-colors duration-300">
                                    <td class="px-8 py-6">
                                        <span class="text-xs font-black text-slate-400 font-mono bg-slate-100 px-2 py-1 rounded-md">
                                            #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 font-black text-sm">
                                                {{ mb_strtoupper(mb_substr($order->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-slate-900 leading-tight">{{ $order->user->name ?? 'Utilisateur supprimé' }}</div>
                                                <div class="text-xs text-slate-400 font-medium">{{ $order->user->email ?? $order->client_email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="text-sm font-bold text-slate-700 truncate max-w-[200px]">
                                            {{ $order->product->title ?? 'Produit supprimé' }}
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="font-black text-slate-900 text-sm">
                                            {{ number_format($order->amount, 0, '', ' ') }} <span class="text-[10px] text-slate-400">CFA</span>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        @if($order->status === 'success')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest border border-emerald-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                Terminé
                                            </span>
                                        @elseif($order->status === 'pending')
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest border border-amber-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                                En attente
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-black uppercase tracking-widest border border-rose-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Échoué
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-8 py-6 text-xs text-slate-400 font-bold">
                                        {{ $order->created_at->format('d M Y') }}
                                        <span class="block text-[10px] opacity-60">{{ $order->created_at->format('H:i') }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center gap-4">
                                            <div class="w-20 h-20 rounded-full bg-slate-50 flex items-center justify-center text-slate-200">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            </div>
                                            <div class="text-slate-400 font-bold text-sm tracking-wide uppercase">Aucune vente enregistrée.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($orders->hasPages())
                    <div class="p-8 bg-slate-50/50 border-t border-slate-100">
                        {{ $orders->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

