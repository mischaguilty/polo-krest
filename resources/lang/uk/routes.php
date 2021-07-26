<?php
return array_merge([
    'welcome' => '',],
    \App\Models\Menuitem::query()->get()->mapWithKeys(function (\App\Models\Menuitem $menuitem) {
        return [
            $menuitem->route_name => optional($menuitem->slug()->first() ?? null, function (\App\Models\Slug $slug) {
                return $slug->getTranslation('name', 'uk');
            })
        ];
    })->toArray()
);
