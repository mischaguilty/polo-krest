<?php

namespace App\Http\Livewire\ProductGroups;

use App\Models\ProductGroup;
use Livewire\Component;

class Save extends Component
{
    public $productGroup, $name;

    public function mount(ProductGroup $productGroup = null)
    {
        $this->productGroup = $productGroup;

        $this->fill($productGroup->toArray());
    }

    public function render()
    {
        return view('product-groups.save');
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

        $this->productGroup->fill($validated)->save();

        $this->emit('showToast', 'success', __('Product Group saved!'));
        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
