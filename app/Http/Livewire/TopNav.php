<?php

namespace App\Http\Livewire;

use App\Models\Menuitem;
use Livewire\Component;

class TopNav extends Component
{
    public function render()
    {
        return view('livewire.top-nav')->with([
            'items' => Menuitem::topmenu()->get(),
        ]);
    }
}
