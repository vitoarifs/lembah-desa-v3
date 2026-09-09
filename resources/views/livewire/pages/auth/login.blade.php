<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.login')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="min-h-screen bg-stone-950 flex items-center justify-center px-4 py-8">

    <div class="w-full max-w-md">

        <!-- Login Card -->
        <div class="bg-stone-900 border border-stone-800 rounded-2xl shadow-xl overflow-hidden">

            <!-- Header -->
            <div class="px-6 sm:px-8 pt-8 pb-6 text-center border-b border-stone-800">

                <!-- Logo / Brand -->
                <div class="flex justify-center mb-5">
                    <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center">
                        <svg
                            class="w-6 h-6 text-amber-500"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 20h18M5 20V9l7-5 7 5v11M9 20v-6h6v6"
                            />
                        </svg>
                    </div>
                </div>

                <h1 class="font-serif text-2xl sm:text-3xl font-bold text-stone-100">
                    Lembah Desa
                </h1>

                <p class="mt-2 text-sm text-stone-400">
                    Masuk ke panel administrasi
                </p>

            </div>


            <!-- Form -->
            <div class="px-6 sm:px-8 py-7">

                <!-- Session Status -->
                <x-auth-session-status
                    class="mb-5"
                    :status="session('status')"
                />

                <form wire:submit="login" class="space-y-5">

                    <!-- Email -->
                    <div>
                        <x-input-label
                            for="email"
                            :value="__('Email')"
                            class="!text-stone-300 !font-medium"
                        />

                        <x-text-input
                            wire:model="form.email"
                            id="email"
                            type="email"
                            name="email"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="nama@email.com"
                            class="block mt-2 w-full !bg-stone-950 !border-stone-700 !text-stone-100 placeholder:!text-stone-600 focus:!border-amber-500 focus:!ring-amber-500 rounded-xl"
                        />

                        <x-input-error
                            :messages="$errors->get('form.email')"
                            class="mt-2"
                        />
                    </div>


                    <!-- Password -->
                    <div>
                        <x-input-label
                            for="password"
                            :value="__('Password')"
                            class="!text-stone-300 !font-medium"
                        />

                        <x-text-input
                            wire:model="form.password"
                            id="password"
                            type="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                            class="block mt-2 w-full !bg-stone-950 !border-stone-700 !text-stone-100 placeholder:!text-stone-600 focus:!border-amber-500 focus:!ring-amber-500 rounded-xl"
                        />

                        <x-input-error
                            :messages="$errors->get('form.password')"
                            class="mt-2"
                        />
                    </div>


                    <!-- Remember + Forgot Password -->
                    <div class="flex items-center justify-between gap-4">

                        <label
                            for="remember"
                            class="inline-flex items-center cursor-pointer"
                        >
                            <input
                                wire:model="form.remember"
                                id="remember"
                                type="checkbox"
                                name="remember"
                                class="rounded border-stone-700 bg-stone-950 text-amber-500 shadow-sm focus:ring-amber-500 focus:ring-offset-stone-900"
                            >

                            <span class="ms-2 text-sm text-stone-400">
                                {{ __('Remember me') }}
                            </span>
                        </label>


                        @if (Route::has('password.request'))
                            <a
                                href="{{ route('password.request') }}"
                                wire:navigate
                                class="text-sm text-amber-500 hover:text-amber-400 transition-colors"
                            >
                                {{ __('Forgot password?') }}
                            </a>
                        @endif

                    </div>


                    <!-- Login Button -->
                    <div class="pt-2">

                        <x-primary-button
                            class="w-full justify-center !bg-amber-600 hover:!bg-amber-500 !text-stone-950 !font-semibold !py-3 !rounded-xl transition-colors"
                        >
                            {{ __('Log in') }}
                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>


        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-xs text-stone-600">
                © {{ date('Y') }} Lembah Desa
            </p>
        </div>

    </div>

</div>