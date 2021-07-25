<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Welcome extends Component
{
    public function route(): \Illuminate\Routing\Route
    {
        return Route::get('/', static::class)->name('welcome');
    }

    public function render()
    {
        return view('welcome')->layout('layouts.guest');
    }
}
