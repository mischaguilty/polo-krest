<?php

namespace App\Traits;


use Illuminate\Database\Eloquent\Builder;

trait FoundBySlug
{
    public function getLocalizedRouteKey($locale)
    {
//        return optional($this->menuitem()->first() ?? null, function (Menuitem $menuitem) use ($locale) {
//            return optional($menuitem->slug()->first() ?? null, function (Slug $slug) use ($locale) {
//                return $slug->getTranslation('name', $locale);
//            });
//        }) ?? slug($this->getTranslation('name', $locale), $locale);

        return slug($this->getTranslation('name', $locale), $locale);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        return self::query()->whereHas('menuitem', function (Builder $builder) use ($value) {
            $builder->whereHas('slug', function (Builder $builder) use ($value) {
                $builder->where([
                    implode('->', [
                        'name', app()->getLocale(),
                    ]) => $value,
                ]);
            });
        })->firstOrFail();
    }
}
