<?php

namespace App\Actions\Install;

use App\Models\Cemetery;
use App\Models\Company;
use App\Models\Menuitem;
use App\Models\ProductGroup;
use App\Models\ServiceGroup;
use App\Models\Slug;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateMenu
{
    use AsAction;

    public string $commandSignature = 'install:create-menu';

    public function handle()
    {
        $company = Company::query()->find(1);

        foreach ([
            [
                'name' => [
                    'ru' => 'О нас',
                    'uk' => 'Про нас',
                ],
                'toplevel_id' => 0,
                'route_name' => 'about',
                'position' => 0,
                'menuable_type' => Company::class,
                'menuable_id' => $company->getKey(),
            ],
            [
                'name' => [
                    'ru' => 'Услуги',
                    'uk' => 'Послуги',
                ],
                'toplevel_id' => 0,
                'route_name' => 'services.index',
                'position' => 1,
                'menuable_type' => ServiceGroup::class,
                'menuable_id' => 0,
                'items' => ServiceGroup::query()->get(),
            ],
            [
                'name' => [
                    'ru' => 'Атрибутика',
                    'uk' => 'Атрибутика',
                ],
                'toplevel_id' => 0,
                'route_name' => 'products.index',
                'position' => 2,
                'menuable_type' => ProductGroup::class,
                'menuable_id' => 0,
                'items' => ProductGroup::query()->get(),
            ],
            [
                'name' => [
                    'ru' => 'Кладбища',
                    'uk' => 'Кладовища',
                ],
                'toplevel_id' => 0,
                'route_name' => 'cemeteries',
                'position' => 3,
                'menuable_type' => Cemetery::class,
                'menuable_id' => 0,
            ],
            'contacts' => [
                'name' => [
                    'ru' => 'Контакты',
                    'uk' => 'Контакти',
                ],
                'toplevel_id' => 0,
                'route_name' => 'contacts',
                'position' => 4,
                'menuable_type' => Company::class,
                'menuable_id' => 1,
            ],
                     ] as $item) {
            $data = collect($item)->except('items')->toArray();
            optional(Menuitem::query()->firstOrCreate($data) ?? null, function (Menuitem $menuitem) use ($item) {
                optional($item['items'] ?? null, function (Collection $items) use ($menuitem) {
                    $className = optional(collect(explode('\\', $menuitem->menuable_type))->last() ?? null, function (string $class) {
                        return optional(collect(explode('::', $class))->first() ?? null, function (string $className) {
                            return $className;
                        });
                    });

                    $itemData = [
                        'toplevel_id' => $menuitem->getKey(),
                        'menuable_id' => 0,
                        'position' => 0,
                        'menuable_type' => get_class($menuitem),
                        'route_name' => $menuitem->route_name,
                    ];

                    if ($className === 'ServiceGroup') {
                        $itemData['name'] = [
                            'uk' => 'Послуги',
                            'ru' => 'Услуги',
                        ];
                        $itemData['route_name'] = 'services.index';
                        $itemData['menuable_type'] = ServiceGroup::class;

                    } else if ($className === 'ProductGroup') {
                        $itemData['name'] = [
                            'uk' => 'Атрибутика',
                            'ru' => 'Атрибутика',
                        ];
                        $itemData['route_name'] = 'products.index';
                        $itemData['menuable_type'] = ProductGroup::class;
                    }

                    $firstItem = optional(Menuitem::query()->firstOrCreate($itemData) ?? null, function (Menuitem $menuitem) {
                        return $menuitem;
                    });

                    foreach ($items as $itemData) {
                        optional(Menuitem::query()->firstOrCreate([
                            'toplevel_id' => $menuitem->getKey(),
                            'route_name' => get_class($itemData) === ServiceGroup::class ? 'services.show' : (get_class($itemData) === ProductGroup::class ? 'products.show' : null),
                            'menuable_type' => get_class($itemData),
                            'menuable_id' => $itemData->getKey(),
                            'name' => optional($itemData->getTranslations('name') ?? null, function (array $translatedName) {
                                return $translatedName;
                            }),
                            'position' => 1,
                        ]) ?? null, function (Menuitem $subItem) {
                            $slug = optional($subItem->slug()->first() ?? null, function (Slug $slug) {
                                dump($slug->name);
                                return $slug;
                            });
                        });
                    }
                });
            });
        }
    }

    public function asCommand(Command $command)
    {
        $this->handle();
    }
}
