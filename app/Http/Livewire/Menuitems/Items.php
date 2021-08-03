<?php

namespace App\Http\Livewire\Menuitems;

use App\Models\Menuitem;
use Livewire\Component;

class Items extends Component
{
    public Menuitem $menuitem;

    public function mount(Menuitem $menuitem)
    {
        $this->menuitem = $menuitem;
    }

    protected function setPosition(Menuitem $menuitem, int $position)
    {
        $menuitem->update([
            'position' => $position ?? 0,
        ]);
        $this->emit('showToast', 'success', __('Позиция обновлена'));
        $this->emitUp('$resetPage');
    }

    public function positionUp(Menuitem $menuitem)
    {
        $currentPosition = $menuitem->position;
        $this->setPosition($menuitem, intval($currentPosition) < PHP_INT_MAX ? $currentPosition + 1 : $currentPosition);
    }

    public function positionDown(Menuitem $menuitem)
    {
        $currentPosition = $menuitem->position;
        $this->setPosition($menuitem, intval($currentPosition) > 0 ? $currentPosition - 1 : $currentPosition);
    }
    public function render()
    {
        return view('menuitems.items')->with([
            'items' => $this->menuitem->children(),
        ]);
    }
}
