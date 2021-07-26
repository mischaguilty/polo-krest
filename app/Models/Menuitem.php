<?php

namespace App\Models;

use Cocur\Slugify\Slugify;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;

class Menuitem extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $table = 'menuitems';

    protected $fillable = [
        'toplevel_id',
        'position',
        'name',
    ];

    protected static function booted()
    {
        static::saved(function (Model $model) {
            optional($model->isDirty('name') ? $model : null, function (Model $model) {
                optional($model->slug()->first() ?? $model->slug()->create(), function (Slug $slug) use ($model) {
                    foreach (LaravelLocalization::getSupportedLocales() as $localeKey => $supportedLocale) {
                        $ruleSetName = optional($supportedLocale['name'] ?? null, function (string $supportedLocaleName) {
                            return strtolower($supportedLocaleName);
                        });
                        $localizedSlugName = optional($ruleSetName ?? null, function (string $ruleSetName) use ($model, $localeKey) {
                                try {
                                    $slugify = new Slugify();
                                    $slugify->activateRuleSet($ruleSetName);
                                    return $slugify->slugify($model->getTrabslation('name', $localeKey));
                                } finally {
                                    return Str::slug($model->getTranslation('name', $localeKey));
                                }
                            }) ?? Str::slug($model->getTranslation('name', $localeKey));

                        $slug->setTranslation('name', $localeKey, $localizedSlugName);
                        $slug->save();
                    }
                });
            });
        });
    }

    public function scopeTopmenu(Builder $builder)
    {
        $builder->where(function (Builder $builder) {
            $builder->where([
                'toplevel_id' => 0,
            ])->orWhere([
                'toplevel_id' => null,
            ]);
        });
    }

    public function toplevel()
    {
        return Menuitem::query()->find($this->toplevel_id);
    }

    public function children()
    {
        return Menuitem::query()->where([
            'toplevel_id' => $this->getKey(),
        ])->get();
    }

    public function getChildrenCountAttribute(): int
    {
        return $this->children()->count();
    }

    public function slug(): MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable', 'sluggable_type', 'sluggable_id', 'id');
    }
}
