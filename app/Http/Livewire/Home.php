<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Throwable;

class Home extends Component
{
    use WithFileUploads;

    public $logo, $name, $description, $currentLocale;
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
            $this->dispatchBrowserEvent('logo:updated');
        } catch (Throwable $exception) {
            $this->emit('showToast', 'danger', $exception->getMessage());
        }
    }

    public function resetLogo()
    {
        optional( $this->company->getFirstMedia('logo') ?? null, function ($media) {
            try {
                $this->company->deleteMedia($media->id);
            } catch (Throwable $exception) {
                $this->emit('showToast', 'danger', $exception->getMessage());
            } finally {
                return $media;
            }
        });
        $this->logo = null;
        $this->emit('$refresh');
    }

    public function save()
    {
        $data = $this->validate([
            'name.*' => ['required', 'string', 'max:50'],
            'description.*' => ['nullable', 'string', 'max:5000'],
        ]);
        $this->company->update($data);
        $this->emit('showToast', 'success', __('Company data was updated'));
        $this->emit('$refresh');
    }
}
