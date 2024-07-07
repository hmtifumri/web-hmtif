<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
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

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div class="grid sm:grid-cols-2 gap-4">
            <!-- NIM -->
            <div>
                <x-input-label for="nim" :value="__('NIM')" />
                <input wire:model="form.nim" id="nim" class="form-input" type="text" name="nim" required
                    autofocus autocomplete="nim" />
                <x-input-error :messages="$errors->get('form.nim')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />

                <input wire:model="form.password" id="password" class="form-input" type="password" name="password"
                    required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3 justify-between">
            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember" class="inline-flex items-center">
                    <input wire:model="form.remember" id="remember" type="checkbox"
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate
                    class="text-sm text-red-600 font-medium hover:underline mt-3 text-center block">Lupas password?</a>
            @endif
        </div>

        <div class="mt-6">
            <button class="w-full btn-primary">
                {{ __('Masuk sekarang') }}
            </button>
            <p class="text-sm text-gray-500 mt-3 text-center">Belum punya akun? <a href="{{ route('register') }}" wire:navigate class="text-blue-600 font-medium hover:underline">Daftar sekarang</a></p>
        </div>
    </form>
</div>
