<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <x-seo :title="$title ?? null" :description="$description ?? null" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')

        @include('components.tracking')
    </head>
    <body class="font-sans antialiased bg-slate-50 selection:bg-amber-500 selection:text-white overflow-x-hidden">
        
        <!-- Decorative Blobs (Premium Ambient Glow) -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
            <div class="blur-blob w-[600px] h-[600px] bg-amber-200/20 top-[-300px] left-[-150px]"></div>
            <div class="blur-blob w-[500px] h-[500px] bg-orange-200/20 bottom-[-150px] right-[-150px] animation-delay-2000"></div>
        </div>

        <div class="min-h-screen flex flex-col">
            
            @if(auth()->user() && auth()->user()->is_admin)
                <!-- =================================================== -->
                <!--   ULTRA-PREMIUM FULL-WIDTH TOP NAVIGATION BAR       -->
                <!-- =================================================== -->
                <header class="bg-white/80 backdrop-blur-xl border-b border-slate-100/80 sticky top-0 z-50 shadow-sm shadow-slate-100/40" x-data="{ mobileMenuOpen: false }">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-20">
                            
                            <!-- Logo and Brand -->
                            <div class="flex items-center gap-8">
                                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-600 flex items-center justify-center shadow-lg shadow-amber-500/20 text-white font-black text-xl">
                                        C
                                    </div>
                                    <div>
                                        <span class="font-black text-slate-900 text-lg tracking-tight font-display">Channel Market</span>
                                        <span class="block text-[10px] font-bold text-amber-500 uppercase tracking-widest -mt-1">Administration</span>
                                    </div>
                                </a>

                                <!-- Desktop Navigation Links (Pill Style) -->
                                <nav class="hidden lg:flex items-center gap-2">
                                    <a href="{{ route('admin.products.index') }}" 
                                       class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('admin.products.*') ? 'bg-amber-500 text-white shadow-md shadow-amber-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                        Catalogue Produits
                                    </a>
                                    <a href="{{ route('admin.orders.index') }}" 
                                       class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('admin.orders.*') ? 'bg-amber-500 text-white shadow-md shadow-amber-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                        Commandes & Ventes
                                    </a>
                                    <a href="{{ route('admin.settings.index') }}" 
                                       class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-white shadow-md shadow-amber-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                        Pixels & Tracking
                                    </a>
                                    <a href="{{ route('admin.activity.index') }}" 
                                       class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 {{ request()->routeIs('admin.activity.*') ? 'bg-amber-500 text-white shadow-md shadow-amber-500/10' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                        Évolution & Déploiements
                                    </a>
                                </nav>
                            </div>

                            <!-- Right Actions (Store link & Profile / Logout) -->
                            <div class="hidden lg:flex items-center gap-6">
                                <!-- External Store -->
                                <a href="{{ route('products.index') }}" target="_blank" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-slate-700 hover:bg-slate-100 font-bold text-xs transition-all duration-300">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    <span>Voir Boutique</span>
                                </a>

                                <!-- User Card & Logout -->
                                <div class="flex items-center gap-3 border-l border-slate-100 pl-6">
                                    <div class="text-right">
                                        <span class="block text-sm font-bold text-slate-800 leading-none">{{ auth()->user()->name }}</span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Admin</span>
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="p-2.5 rounded-xl border border-slate-200 text-slate-500 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-all duration-300">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Mobile Menu Toggle Button -->
                            <div class="flex items-center lg:hidden">
                                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 focus:outline-none">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenuOpen"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenuOpen" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>

                        </div>
                    </div>

                    <!-- Mobile Navigation Drawer -->
                    <div x-show="mobileMenuOpen" class="lg:hidden bg-white border-b border-slate-100 py-4 px-4 space-y-2" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                        <a href="{{ route('admin.products.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('admin.products.*') ? 'bg-amber-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Catalogue Produits
                        </a>
                        <a href="{{ route('admin.orders.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('admin.orders.*') ? 'bg-amber-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Commandes & Ventes
                        </a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Pixels & Tracking
                        </a>
                        <a href="{{ route('admin.activity.index') }}" class="block px-4 py-3 rounded-xl text-sm font-bold {{ request()->routeIs('admin.activity.*') ? 'bg-amber-500 text-white' : 'text-slate-600 hover:bg-slate-50' }}">
                            Évolution & Déploiements
                        </a>
                        
                        <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="block text-xs font-black text-slate-800">{{ auth()->user()->name }}</span>
                                <span class="block text-[10px] font-bold text-slate-400 uppercase">Admin</span>
                            </div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 text-rose-600 font-bold text-xs">
                                    Se déconnecter
                                </button>
                            </form>
                        </div>
                    </div>
                </header>

                <!-- Page Header (Universal & Standard Width) -->
                @isset($header)
                    <div class="bg-white border-b border-slate-100 py-10">
                        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </div>
                @endisset

                <!-- Main Content (Full Width Standard Container) -->
                <main class="flex-1 py-12">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>

            @else
                <!-- =================================================== -->
                <!--   STANDARD CLIENT DASHBOARD LAYOUT                  -->
                <!-- =================================================== -->
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white/60 backdrop-blur-xl border-b border-slate-100/50 sticky top-16 z-30">
                        <div class="container-app py-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="flex-1">
                    {{ $slot }}
                </main>
            @endif

        </div>

        @stack('scripts')
    </body>
</html>
