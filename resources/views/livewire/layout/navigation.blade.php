<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};
?>

<div>
<!-- Mobile Overlay -->
<div
    x-show="sidebarOpen"
    x-transition.opacity
    @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden"
    x-cloak
></div>


<!-- Sidebar -->
<aside
    class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-gray-200 bg-white transition-transform duration-200"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
>

    <!-- Logo -->
    <div class="flex h-16 shrink-0 items-center border-b border-gray-200 px-6">

        <a
            href="{{ route('dashboard') }}"
            wire:navigate
            class="flex min-w-0 items-center gap-3"
        >
            <x-application-logo
                class="h-9 w-auto shrink-0 fill-current text-gray-800"
            />

            <span class="truncate text-lg font-bold text-gray-800">
                {{ config('app.name', 'Lembah Desa') }}
            </span>
        </a>

        <!-- Close Sidebar - Mobile -->
        <button
            type="button"
            @click="sidebarOpen = false"
            class="ml-auto rounded-lg p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-600 lg:hidden"
            aria-label="Close navigation"
        >
            <svg
                class="h-5 w-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

    </div>


    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto px-4 py-6">

        <!-- Section Label -->
        <p class="mb-3 px-3 text-xs font-semibold uppercase tracking-wider text-gray-400">
            Menu
        </p>

        <div class="space-y-1">

            <!-- Dashboard -->
            <a
                href="{{ route('dashboard') }}"
                wire:navigate
                @click="sidebarOpen = false"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('dashboard')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"
                    />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Kategori Kuliner -->
            <a
                href="{{ route('admin.kuliner.kategori.index') }}"
                wire:navigate
                @click="sidebarOpen = false"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('admin.kuliner.kategori')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"
                    />
                </svg>
                <span>Kategori Kuliner</span>
            </a>

            <!-- Menu Kuliner -->
            <a
                href="{{ route('admin.kuliner.menu.index') }}"
                wire:navigate
                @click="sidebarOpen = false"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('admin.kuliner.menu')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"
                    />
                </svg>
                <span>Menu Kuliner</span>
            </a>

            <!-- Event dan Acara -->
            <a
                href="{{ route('admin.event.index') }}"
                wire:navigate
                @click="sidebarOpen = false"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('admin.event.index')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"
                    />
                </svg>
                <span>Event dan Acara</span>
            </a>

            <!-- Identitas Website -->
            <a
                href="{{ route('admin.identitas-website.index') }}"
                wire:navigate
                @click="sidebarOpen = false"
                class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                    {{ request()->routeIs('admin.identitas-website.index')
                        ? 'bg-gray-900 text-white'
                        : 'text-gray-600 hover:bg-gray-100 hover:text-gray-900' }}"
            >
                <svg
                    class="h-5 w-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"
                    />
                </svg>
                <span>Identitas Website</span>
            </a>

        </div>

    </nav>


    <!-- User Section -->
    <div class="border-t border-gray-200 p-4">

        <!-- User Information -->
        <div class="mb-3 flex items-center gap-3 px-2">

            <!-- Avatar -->
            <div
                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-gray-900 text-sm font-semibold text-white"
            >
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <!-- Name & Email -->
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-semibold text-gray-800">
                    {{ auth()->user()->name }}
                </p>

                <p class="truncate text-xs text-gray-500">
                    {{ auth()->user()->email }}
                </p>
            </div>

        </div>


        <!-- Profile -->
        <a
            href="{{ route('profile') }}"
            wire:navigate
            @click="sidebarOpen = false"
            class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium text-gray-600 transition hover:bg-gray-100 hover:text-gray-900"
        >

            <svg
                class="h-5 w-5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                />
            </svg>

            <span>Profile</span>

        </a>


        <!-- Logout -->
        <button
            type="button"
            wire:click="logout"
            class="mt-1 flex w-full items-center gap-3 rounded-lg px-3 py-2.5 text-left text-sm font-medium text-gray-600 transition hover:bg-red-50 hover:text-red-600"
        >

            <svg
                class="h-5 w-5 shrink-0"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                />
            </svg>

            <span>Log Out</span>

        </button>

    </div>

</aside>
</div>