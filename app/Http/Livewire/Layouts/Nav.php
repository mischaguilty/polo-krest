<?php

namespace App\Http\Livewire\Layouts;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nav extends Component
{
    protected $listeners = ['$refresh'];

    public function render()
    {
        return view('layouts.nav');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->to('/');
    }
}
