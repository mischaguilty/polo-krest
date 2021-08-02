<?php

namespace App\Http\Livewire\Cemeteries;

use App\Models\Cemetery;
use Livewire\Component;

class Save extends Component
{
    public $cemetery, $name;

    public function mount(Cemetery $cemetery = null)
    {
        $this->cemetery = $cemetery;

        $this->fill($cemetery->toArray());
    }

    public function render()
    {
        return view('cemeteries.save');
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

        $this->cemetery->fill($validated)->save();

        $this->emit('showToast', 'success', __('Cemetery saved!'));
        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
