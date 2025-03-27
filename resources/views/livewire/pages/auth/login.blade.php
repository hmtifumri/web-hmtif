<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        // Rate limiting key based on user's NIM and IP address
        $this->ensureIsNotRateLimited();

        $this->validate();

        try {
            $this->form->authenticate();

            // Regenerate session and reset rate limiter on successful login
            Session::regenerate();

            RateLimiter::clear($this->throttleKey());

            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
        } catch (\Exception $e) {
            // Increment rate limiter on failure
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.nim' => __('These credentials do not match our records.'),
            ]);
        }
    }

    /**
     * Ensure the login request is not rate limited.
     */
    public function ensureIsNotRateLimited(): void
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            throw ValidationException::withMessages([
                'form.nim' => __('Too many login attempts. Please try again in :seconds seconds.', [
                    'seconds' => RateLimiter::availableIn($this->throttleKey()),
                ]),
            ]);
        }
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::lower($this->form->nim) . '|' . request()->ip();
    }
};
?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <div class="grid sm:grid-cols-2 gap-4">
            <!-- NIM -->
            <div>
                <x-input-label for="nim" :value="__('NIM')" />
                <input wire:model="form.nim" id="nim" class="form-input" type="text" name="nim" required
                    autofocus autocomplete="off" />
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
            <p class="text-sm text-gray-500 mt-3 text-center">Belum punya akun? <a href="{{ route('register') }}"
                    wire:navigate class="text-blue-600 font-medium hover:underline">Daftar sekarang</a></p>
        </div>
    </form>
</div>
