<?php

namespace App\Http\Livewire\Cemeteries;

use App\Models\Cemetery;
use Livewire\Component;

class Read extends Component
{
    public $cemetery;

    public function mount(Cemetery $cemetery)
    {
        $this->cemetery = $cemetery;
    }

    public function render()
    {
        return view('cemeteries.read');
    }
}
