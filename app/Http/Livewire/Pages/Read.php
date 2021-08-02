<?php

namespace App\Http\Livewire\Pages;

use App\Models\Page;
use Livewire\Component;

class Read extends Component
{
    public $page;

    public function mount(Page $page)
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('pages.read');
    }
}
