<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username = '';
    public $password = '';

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Coba Login (Laravel defaultnya pakai field 'email' & 'password')
        if (Auth::attempt(['email' => $this->username, 'password' => $this->password])) {

            session()->regenerate();

            // LOGIKA PENGARAHAN (REDIRECT)
            switch ($this->username) {
                case 'kasir':
                    return redirect('/kasir');
                case 'dapur_food':
                    return redirect('/dapur/food');
                case 'dapur_drink':
                    return redirect('/dapur/drink');
                case 'waiter':
                    return redirect('/waiter');
                case 'sales':
                    return redirect('/sales');
                default:
                    return redirect('/kasir');
            }
        }

        $this->addError('username', 'Username atau Password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
        // Pastikan layoutnya benar, atau hapus ->layout() jika pake default
    }
}