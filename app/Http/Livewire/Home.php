<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Media;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Home extends Component
{
    use WithFileUploads;

    public $logo, $name, $currentLocale;
    public Company $company;

    public function mount()
    {
        $this->company = optional(View::shared('company') ?? null, function (Company $company) {
            return $company;
        }) ?? new Company();
        if (!$this->company->exists) {
            $this->company->name = collect(LaravelLocalization::getSupportedLanguagesKeys())->mapWithKeys(function (string $localeKey) {
                return [
                    $localeKey => Company::$DEFAULT_NAME,
                ];
            })->toArray();
            $this->company->save();
        }

        if ($this->company) {
            $this->fill($this->company->toArray());
        }

        $this->logo = $this->company->getFirstMedia('logo');
        $this->currentLocale = app()->getLocale();
    }

    public function route()
    {
        return Route::get(trim(RouteServiceProvider::HOME, '\/'), static::class)
            ->middleware('auth')->name('home');
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function getRules(): array
    {
        return [
            'currentLocale' => Rule::in(LaravelLocalization::getSupportedLanguagesKeys()),
            'logo' => [
                'image', 'max:1024',
            ]
        ];
    }

    public function updatedLogo()
    {
        $this->validate([
            'logo' => [
                'image',
            ],
        ]);
    }

    public function save()
    {
        try {
            $this->company->addMedia(storage_path(implode(DIRECTORY_SEPARATOR, [
                'app',
                'livewire-tmp',
                $this->logo->getFilename(),
            ])))
                ->preservingOriginal()
                ->usingFileName($this->logo->getClientOriginalName())
                ->usingName(implode(' ', [
                    $this->company->name,
                    'Logo',
                ]))
                ->toMediaCollection('logo')
                ->save();
            $this->emit('$refresh');
        } catch (\Throwable $exception) {
            dd($exception->getMessage());
        }
    }

    public function resetLogo()
    {
        optional( $this->company->getFirstMedia('logo') ?? null, function (Media $media) {
            try {
                $this->company->deleteMedia($media->id);
            } finally {
                return $media;
            }
        });
        $this->logo = null;
        $this->emit('$refresh');
    }
}
