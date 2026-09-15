<?php
use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
new class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
};
?>
<div>
    <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm lg:hidden" x-cloak></div>
    <aside class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-stone-800 bg-stone-950 transition-transform duration-200" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'">
        <div class="flex h-16 shrink-0 items-center border-b border-stone-800 px-5">
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex min-w-0 items-center gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden">
                    @if ($siteIdentity?->logo)
                        <img
                            src="{{ asset('storage/' . $siteIdentity->logo) }}"
                            alt="{{ $siteIdentity->nama_website ?? 'Logo' }}"
                            class="h-full w-full object-contain"
                        >
                    @else
                        <x-application-logo class="h-6 w-auto fill-current text-amber-500" />
                    @endif
                </div>
                <div class="min-w-0">
                    <span class="block truncate text-sm font-bold text-stone-100">{{ config('app.name', 'Lembah Desa') }}</span>
                    <span class="block text-[10px] uppercase tracking-widest text-stone-600">Admin Panel</span>
                </div>
            </a>
            <button type="button" @click="sidebarOpen = false" class="ml-auto rounded-lg p-2 text-stone-500 transition hover:bg-stone-900 hover:text-stone-200 lg:hidden" aria-label="Close navigation">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav class="flex-1 overflow-y-auto px-3 py-6">
            <p class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-stone-600">Menu Utama</p>
            <div class="space-y-1">
                <a href="{{ route('admin.dashboard') }}" wire:navigate @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500/10 text-amber-400' : 'text-stone-400 hover:bg-stone-900 hover:text-stone-100' }}">
                    <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.dashboard') ? 'text-amber-500' : 'text-stone-600 group-hover:text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.kuliner.kategori.index') }}" wire:navigate @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.kuliner.kategori.*') ? 'bg-amber-500/10 text-amber-400' : 'text-stone-400 hover:bg-stone-900 hover:text-stone-100' }}">
                    <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.kuliner.kategori.*') ? 'text-amber-500' : 'text-stone-600 group-hover:text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8" />
                    </svg>
                    <span>Kategori Kuliner</span>
                </a>
                <a href="{{ route('admin.kuliner.menu.index') }}" wire:navigate @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.kuliner.menu.*') ? 'bg-amber-500/10 text-amber-400' : 'text-stone-400 hover:bg-stone-900 hover:text-stone-100' }}">
                    <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.kuliner.menu.*') ? 'text-amber-500' : 'text-stone-600 group-hover:text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <span>Menu Kuliner</span>
                </a>
                <a href="{{ route('admin.event.index') }}" wire:navigate @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.event.*') ? 'bg-amber-500/10 text-amber-400' : 'text-stone-400 hover:bg-stone-900 hover:text-stone-100' }}">
                    <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.event.*') ? 'text-amber-500' : 'text-stone-600 group-hover:text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Event dan Acara</span>
                </a>
                @php
                    $unreadContactCount = \App\Models\ContactMessage::where('is_read', false)->count();
                @endphp
                <a href="{{ route('admin.contact-messages.index') }}" wire:navigate @click="sidebarOpen = false" class="group flex items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.contact-messages.*') ? 'bg-amber-500/10 text-amber-400' : 'text-stone-400 hover:bg-stone-900 hover:text-stone-100' }}">
                    <div class="flex items-center gap-3">
                        <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.contact-messages.*') ? 'text-amber-500' : 'text-stone-600 group-hover:text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>Pesan Masuk</span>
                    </div>
                    @if ($unreadContactCount > 0)
                        <span class="min-w-5 h-5 px-1.5 inline-flex items-center justify-center rounded-full bg-amber-500 text-[10px] font-bold text-stone-950">{{ $unreadContactCount }}</span>
                    @endif
                </a>
            </div>
            @if (auth()->user()->role === 'admin')
                <div class="mt-8">
                    <p class="mb-3 px-3 text-[10px] font-semibold uppercase tracking-[0.18em] text-stone-600">Pengaturan Sistem</p>
                    <div class="space-y-1">
                        <a href="{{ route('admin.identitas-website.index') }}" wire:navigate @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.identitas-website.*') ? 'bg-amber-500/10 text-amber-400' : 'text-stone-400 hover:bg-stone-900 hover:text-stone-100' }}">
                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.identitas-website.*') ? 'text-amber-500' : 'text-stone-600 group-hover:text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37 2.37a1.724 1.724 0 00-1.065 2.572c1.756.426 2.924 1.756 3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            </svg>
                            <span>Identitas Website</span>
                        </a>
                        <a href="{{ route('admin.kelola-content-manager.index') }}" wire:navigate @click="sidebarOpen = false" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ request()->routeIs('admin.kelola-content-manager.*') ? 'bg-amber-500/10 text-amber-400' : 'text-stone-400 hover:bg-stone-900 hover:text-stone-100' }}">
                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('admin.kelola-content-manager.*') ? 'text-amber-500' : 'text-stone-600 group-hover:text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <span>Kelola Content Manager</span>
                        </a>
                    </div>
                </div>
            @endif
        </nav>
        <div class="border-t border-stone-800 bg-stone-950 p-4">
            <div class="mb-3 flex items-center gap-3 px-1">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-amber-500/10 border border-amber-500/20 text-sm font-bold text-amber-500">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-stone-200">{{ auth()->user()->name }}</p>
                    <p class="truncate text-xs text-stone-600">{{ auth()->user()->email }}</p>
                </div>
            </div>
            <div class="mb-2 px-1">
                <span class="inline-flex rounded-md border border-stone-800 bg-stone-900 px-2 py-1 text-[10px] font-semibold text-amber-500 capitalize">
                    {{ str_replace('_', ' ', auth()->user()->role) }}
                </span>
            </div>
            <a href="{{ route('profile') }}" wire:navigate @click="sidebarOpen = false" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-stone-400 transition-colors hover:bg-stone-900 hover:text-stone-100">
                <svg class="h-5 w-5 shrink-0 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profile</span>
            </a>
            <button type="button" wire:click="logout" class="mt-1 flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-left text-sm font-medium text-stone-400 transition-colors hover:bg-rose-950/30 hover:text-rose-400">
                <svg class="h-5 w-5 shrink-0 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Log Out</span>
            </button>
        </div>
    </aside>
</div>