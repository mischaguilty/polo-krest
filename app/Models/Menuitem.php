<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
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
        'route_name',
        'toplevel_id',
        'position',
        'name',
        'menuable_type',
        'menuable_id',
    ];

    protected static function booted()
    {
        static::saved(function (Model $model) {
            optional($model->isDirty('name') ? $model->load(['slug']) : null, function (Model $model) {
                if (method_exists($model, 'slug')) {
                    optional($model->slug()->firstOrCreate() ?? null, function (Slug $slug) use ($model) {
                        foreach (LaravelLocalization::getSupportedLocales() as $localeKey => $supportedLocale) {
                            $localizedSlugName = slug($model->getTranslation('name', $localeKey), $localeKey);
                            $slug->setTranslation('name', $localeKey, $localizedSlugName);
                            $slug->save();
                        }
                    });
                }
                if (method_exists($model, 'menuable')) {
                    optional($model->menuable()->first() ?? null, function (Model $menuable) use ($model) {
                        foreach (LaravelLocalization::getSupportedLocales() as $localeKey => $supportedLocale) {
                            $menuable->setTranslation('name', $localeKey, $model->getTranslation('name', $localeKey));
                            $menuable->save();
                        }
                    });
                }
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
        ])->orderBy('position')->get();
    }

    public function getChildrenCountAttribute(): int
    {
        return $this->children()->count();
    }

    public function slug(): MorphOne
    {
        return $this->morphOne(Slug::class, 'sluggable', 'sluggable_type', 'sluggable_id', 'id');
    }

    public function menuable(): MorphTo
    {
        return $this->morphTo('menuable', 'menuable_type', 'menuable_id', 'id');
    }
}
