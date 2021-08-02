<?php

namespace App\Http\Livewire\ServiceGroups;

use App\Models\ServiceGroup;
use Livewire\Component;

class Save extends Component
{
    public $serviceGroup, $name;

    public function mount(ServiceGroup $serviceGroup = null)
    {
        $this->serviceGroup = $serviceGroup;

        $this->fill($serviceGroup->toArray());
    }

    public function render()
    {
        return view('service-groups.save');
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:255'],
        ];
    }

    public function save()
    {
        $validated = $this->validate();

        $this->serviceGroup->fill($validated)->save();

        $this->emit('showToast', 'success', __('Service Group saved!'));
        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
