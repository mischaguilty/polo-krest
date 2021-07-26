<?php

namespace App\Http\Livewire\Menuitems;

use App\Models\Menuitem;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Read extends Component
{
    public $menuitem, $currentLocale;

    public function mount(Menuitem $menuitem)
    {
        $this->menuitem = $menuitem;
        $this->currentLocale = app()->getLocale();
    }

    public function render()
    {
        return view('menuitems.read');
    }

    public function getRules(): array
    {
        return [
            'currentLocale' => Rule::in(LaravelLocalization::getSupportedLanguagesKeys()),
        ];
    }

    public function updatedCurrentLocale()
    {
        app()->setLocale($this->currentLocale);
        $this->emit('$refresh');
    }
}
