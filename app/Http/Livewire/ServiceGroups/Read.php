<?php

namespace App\Http\Livewire\ServiceGroups;

use App\Models\ServiceGroup;
use Livewire\Component;

class Read extends Component
{
    public $serviceGroup;

    public function mount(ServiceGroup $serviceGroup)
    {
        $this->serviceGroup = $serviceGroup;
    }

    public function render()
    {
        return view('service-groups.read');
    }
}
