<?php

namespace App\Http\Livewire\ProductGroups;

use App\Models\ProductGroup;
use Livewire\Component;

class Read extends Component
{
    public $productGroup;

    public function mount(ProductGroup $productGroup)
    {
        $this->productGroup = $productGroup;
    }

    public function render()
    {
        return view('product-groups.read');
    }
}
