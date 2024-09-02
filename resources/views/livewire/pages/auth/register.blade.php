<?php

use App\Models\User;
use App\Models\Periode;
use Illuminate\Auth\Events\Registered;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Models\Divisi;

new #[Layout('layouts.guest')] class extends Component {
    #[Validate('required|string|max:255|unique:users,nim')]
    public string $nim = '';

    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|email|max:255|unique:users,email')]
    public string $email = '';

    #[Validate('nullable|string|max:20')]
    public string $phone = '';

    #[Validate('required|string')]
    public string $divisi = '';

    #[Validate('required|string')]
    public string $jabatan = '';

    #[Validate('required|string')]
    public string $gender = '';

    #[Validate('required|string|min:6|confirmed')]
    public string $password = '';

    #[Validate('required|string')]
    public string $password_confirmation = '';

    public $periode_id;
    public $divisiOptions = [];
    public $ksbJabatanOptions = [];
    public $defaultJabatanOptions = [];

    public function mount()
    {
        $this->periode_id = Periode::where('status', 'aktif')->first();
        $divisi = Divisi::where('divisi', '!=', 'admin')->get();

        $this->divisiOptions = $divisi;

        // Get assigned roles for the active period
        $assignedRoles = User::where('periode_id', $this->periode_id->id)
            ->whereIn('jabatan', ['bupati', 'wakil_bupati', 'sekum', 'sekretaris', 'bendum'])
            ->pluck('jabatan')
            ->toArray();

        $this->ksbJabatanOptions = [
            'bupati' => 'Bupati',
            'wakil_bupati' => 'Wakil Bupati',
            'sekum' => 'Sekretaris Umum',
            'sekretaris' => 'Sekretaris',
            'bendum' => 'Bendahara Umum',
        ];

        // Filter out the already assigned roles
        $this->ksbJabatanOptions = array_diff_key($this->ksbJabatanOptions, array_flip($assignedRoles));
        if (empty($this->ksbJabatanOptions)) {
            $this->divisiOptions = $this->divisiOptions->filter(function ($divisi) {
                return $divisi->singkatan !== 'ksb';
            });
        }

        $this->defaultJabatanOptions = [
            'kadiv' => 'Kepala Divisi',
            'stafsus' => 'Staf Khusus',
            'anggota' => 'Anggota',
            'magang' => 'Magang',
        ];
    }

    public function updatedDivisi()
    {
        if ($this->divisi) {
            $assignedDivisiRoles = User::where('periode_id', $this->periode_id->id)
                ->where('divisi_id', Divisi::where('singkatan', $this->divisi)->first()->id)
                ->pluck('jabatan')
                ->toArray();

            $this->defaultJabatanOptions = [
                'kadiv' => 'Kepala Divisi',
                'stafsus' => 'Staf Khusus',
                'anggota' => 'Anggota',
                'magang' => 'Magang',
            ];

            $rolesToExclude = ['kadiv'];

            foreach ($rolesToExclude as $role) {
                if (in_array($role, $assignedDivisiRoles)) {
                    unset($this->defaultJabatanOptions[$role]);
                }
            }
        }
    }

    public function updatedPasswordConfirmation()
    {
        $this->validate([
            'password_confirmation' => ['same:password'],
        ]);
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $divisi = Divisi::where('singkatan', $this->divisi)->first();

        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);
        $validated['periode_id'] = $this->periode_id->id;
        $validated['divisi_id'] = $divisi->id;

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div>
    @php
        $pengaturan = DB::table('pengaturan_pendaftaran')->first();
        $today = now()->toDateString();
    @endphp

    @if (
        $pengaturan &&
            $today >= $pengaturan->tanggal_mulai &&
            $today <= $pengaturan->tanggal_selesai &&
            $pengaturan->status == 'dibuka')
        <div class="mb-7 text-center">
            <h1 class="capitalize text-xl sm:text-2xl md:text-3xl font-bold font-plusjakartasans">Pendaftaran Anggota
                HM-TIF <br> Periode {{ $this->periode_id->periode }}</h1>
            @php
                $tanggalSelesai = Illuminate\Support\Carbon::parse($pengaturan->tanggal_selesai);
                Illuminate\Support\Carbon::setLocale('id');
            @endphp
            <p class="text-gray-500 mt-4">Pendaftaran dibuka hanya {{ $tanggalSelesai->diffForHumans() }}</p>
        </div>
        <form wire:submit.prevent="register">
            <div class="grid sm:grid-cols-2 gap-4">
                <!-- NIM -->
                <div>
                    <x-input-label for="nim" :value="__('NIM')" />
                    <input wire:model="nim" id="nim" class="form-input" type="text" name="nim" required
                        autofocus autocomplete="nim" wire:model.blur='nim' />
                    @error('nim')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nama')" />
                    <input wire:model="name" id="name" class="form-input" type="text" name="name" required
                        autocomplete="name" wire:model.blur='name' />
                    @error('name')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <input wire:model="email" id="email" class="form-input" type="email" name="email" required
                        autocomplete="username" wire:model.blur='email' />
                    @error('email')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <x-input-label for="phone" :value="__('No WA/HP')" />
                    <input wire:model="phone" id="phone" class="form-input" type="text" name="phone"
                        autocomplete="phone" wire:model.blur='phone' />
                    @error('phone')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Divisi -->
                <div>
                    <x-input-label for="divisi" :value="__('Divisi')" />
                    <select wire:model="divisi" id="divisi" class="form-input" wire:model.change='divisi'>
                        <option value="">{{ __('Pilih Divisi') }}</option>
                        @foreach ($divisiOptions as $key => $value)
                            <option value="{{ $value->singkatan }}">{{ $value->divisi }}</option>
                        @endforeach
                    </select>
                    @error('divisi')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <x-input-label for="jabatan" :value="__('Jabatan')" wire:model.change="jabatan" />
                    <select wire:model="jabatan" id="jabatan" class="form-input">
                        <option value="">{{ __('Pilih Jabatan') }}</option>
                        @if ($divisi == 'ksb')
                            @foreach ($ksbJabatanOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        @else
                            @foreach ($defaultJabatanOptions as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('jabatan')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Gender -->
            <div class="my-4">
                <x-input-label for="gender" :value="__('Jenis Kelamin')" />
                <div class="flex items-center">
                    <label class="inline-flex items-center mr-4">
                        <input wire:model="gender" type="radio" value="L" class="form-radio text-blue-600"
                            wire:model.blur='gender'>
                        <span class="ml-2">{{ __('Laki-laki') }}</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input wire:model="gender" type="radio" value="P" class="form-radio text-blue-600"
                            wire:model.blur='gender'>
                        <span class="ml-2">{{ __('Perempuan') }}</span>
                    </label>
                </div>
                @error('gender')
                    <span class="error-msg">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid sm:grid-cols-2 gap-4">
                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <input wire:model="password" id="password" class="form-input" type="password" name="password"
                        required autocomplete="new-password" wire:model.blur='password' />
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <input wire:model="password_confirmation" id="password_confirmation" class="form-input"
                        type="password" name="password_confirmation" required autocomplete="new-password"
                        wire:model.live='password_confirmation' />
                    @error('password_confirmation')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mt-6">
                <button class="w-full btn-primary">
                    {{ __('Daftar Sekarang') }}
                </button>
                <p class="text-sm text-gray-500 mt-3 text-center">Sudah punya akun? <a href="{{ route('login') }}"
                        wire:navigate class="text-blue-600 font-medium hover:underline">Masuk</a></p>
            </div>
        </form>
    @else
        <div class="text-center">
            <h1 class="capitalize text-xl sm:text-2xl md:text-3xl font-bold font-plusjakartasans ">Maaf, Pendaftaran
                Anggota
                HM-TIF <br> Periode {{ $this->periode_id->periode }} Telah Ditutup</h1>
        </div>
    @endif
</div>
