<?php

namespace App\Http\Livewire\Pages;

use App\Models\Page;
use Livewire\Component;

class Save extends Component
{
    public $page, $name;

    public function mount(Page $page = null)
    {
        $this->page = $page;

        $this->fill($page->toArray());
    }

    public function render()
    {
        return view('pages.save');
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

        $this->page->fill($validated)->save();

        $this->emit('showToast', 'success', __('Page saved!'));
        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
