<?php

namespace App\Http\Livewire\Menuitems;

use App\Models\Menuitem;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'Name';
    public $sorts = ['Name', 'Newest', 'Oldest'];
    public $filter = 'All';
    public $filters = ['All', 'First 100'];

    protected $listeners = ['$refresh'];

    public function route()
    {
        return Route::get('menu', static::class)
            ->name('menu')
            ->middleware('auth');
    }

    public function render()
    {
        return view('menuitems.index', [
            'menuitems' => $this->query()->paginate(),
        ]);
    }

    public function query()
    {
        return Menuitem::topmenu()->orderBy('position');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function delete(Menuitem $menuitem)
    {
        $menuitem->delete();

        $this->emit('showToast', 'success', __('deleted!'));
    }

    protected function setPosition(Menuitem $menuitem, int $position)
    {
        $menuitem->update([
            'position' => $position ?? 0,
        ]);
        $this->emit('showToast', 'success', __('Позиция обновлена'));
        $this->resetPage();
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
}
