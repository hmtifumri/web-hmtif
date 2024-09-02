<?php

namespace App\Livewire\Dashboard\User;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Security extends Component
{
    public $user;
    public $oldPassword, $newPassword;

    protected $rules = [
        'oldPassword' => ['required'],
        'newPassword' => ['required', 'min:8'],
    ];

    protected $messages = [
        'oldPassword.current_password' => 'Password lama tidak sesuai.',
        'newPassword.min' => 'Password baru minimal 8 karakter.',
        'newPassword.required' => 'Password baru harus diisi.',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedOldPassword()
    {
        if (!Hash::check($this->oldPassword, $this->user->password)) {
            $this->addError('oldPassword', 'Password lama tidak sesuai.');
            return;
        }
    }

    public function render()
    {
        return view('livewire.dashboard.user.security');
    }

    public function changePassword()
    {
        $this->validate();

        // Implementasi perubahan password menggunakan Hash
        $this->user->password = Hash::make($this->newPassword);
        $this->user->save();

        session()->flash('success', 'Password berhasil diubah.');
    }
}
