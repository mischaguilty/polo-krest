<?php

namespace App\Http\Livewire\Layouts;

use App\Models\Company;
use App\Models\Media;
use Illuminate\Support\Facades\View;
use Livewire\Component;

class Guest extends Component
{
    public function render()
    {
        return view('layouts.guest')->with([
            'logo' => optional(View::shared('company') ?? null, function (Company $company) {
                return optional($company->getFirstMedia('logo') ?? null, function (Media $media) {
                    return $media;
                });
            }),
        ]);
    }
}
