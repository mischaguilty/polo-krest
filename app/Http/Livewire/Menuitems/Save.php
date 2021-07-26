<?php

namespace App\Http\Livewire\Menuitems;

use App\Models\Menuitem;
use App\Models\Slug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class Save extends Component
{
    public $menuitem, $name, $position, $currentLocale, $slug;

    public function fill($values)
    {
        $publicProperties = array_keys($this->getPublicPropertiesDefinedBySubClass());
        $publicProperties[] = 'slug';

        if ($values instanceof Model) {
            $values = $values->toArray();
        }

        foreach ($values as $key => $value) {
            if (in_array($this->beforeFirstDot($key), $publicProperties)) {
                if(is_array($value)) {
                    foreach ($value as $k => $v) {
                        if (is_array($v)) {
                            foreach ($v as $kk => $vv) {
                                data_set($this, implode('.', [
                                    $key, $k, $kk,
                                ]), $vv);
                            }
                        } else {
                            data_set($this, implode('.', [
                                $key, $k,
                            ]), $v);
                        }
                    }
                } else {
                    data_set($this, $key, $value);
                }
            }
        }
    }

    public function mount(Menuitem $menuitem = null)
    {
        $this->menuitem = optional($menuitem ?? null, function (Menuitem $menuitem) {
            return $menuitem->load(['slug']);
        });

        if ($this->menuitem) {
            $this->fill($menuitem->toArray());
        }
        $this->currentLocale = app()->getLocale();
        $this->slug = $this->menuitem ? optional($this->menuitem->slug()->first() ?? null, function (Slug $slug) {
            return !empty($slug->getTranslations('name')) ? $slug->getTranslations('name') : Slug::defaultArray();
        }) : Slug::defaultArray();
    }

    public function updatedCurrentLocale()
    {
        app()->setLocale($this->currentLocale);
        $this->emit('$refresh');
    }

    public function render()
    {
        return view('menuitems.save');
    }

    public function rules(): array
    {
        return collect([
            'position' => ['nullable', 'int:0,200'],
            'currentLocale' => [
                Rule::in(LaravelLocalization::getSupportedLanguagesKeys()),
            ],
        ])->mergeRecursive(collect(LaravelLocalization::getSupportedLanguagesKeys())->mapWithKeys(function (string $localeKey) {
            return [
                implode('.', [
                    'name', $localeKey,
                ]) => ['required', 'max:150'],
            ];
        })->toArray())->toArray();
    }

    public function save()
    {
        $validated = $this->validate();

        $this->menuitem->fill($validated)->save();

        $this->emit('showToast', 'success', __('Menuitem saved!'));
        $this->emit('hideModal');
        $this->emit('$refresh');
    }
}
