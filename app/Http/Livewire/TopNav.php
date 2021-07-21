<?php

namespace App\Http\Livewire;

use App\Models\Topnavitem;
use Livewire\Component;

class TopNav extends Component
{
    public function render()
    {
        $items = Topnavitem::query()
            ->orderBy('position')
            ->orderBy('name')
            ->get();

        $right = ($items->count() / 2);
        $left = ($items->count() % 2) ? ($right + 1) : $right;

        return view('livewire.top-nav')->with([
            'items' => [],
            'right' => $right,
            'left' => $left,
        ]);
    }
}
