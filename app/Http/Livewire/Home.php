<?php

namespace App\Http\Livewire;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class Home extends Component
{
    public function route()
    {
        return Route::get(trim(RouteServiceProvider::HOME, '\/'), static::class)
            ->middleware('auth')->name('home');
    }

    public function render()
    {
        return view('home');
    }
}
