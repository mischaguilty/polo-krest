<?php

namespace App\Actions\Install;

use App\Models\Cemetery;
use App\Models\Company;
use App\Models\Menuitem;
use App\Models\ProductGroup;
use App\Models\ServiceGroup;
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
                'items' => ServiceGroup::query()->get()->map(function (ServiceGroup $serviceGroup) {
                    return [
                        'name' => $serviceGroup->getTranslations('name'),
                        'menuable_type' => ServiceGroup::class,
                        'menuable_id' => $serviceGroup->getKey(),
                        'position' => 1,
                        'route_name' => 'services.show',
                        'toplevel_id' => 2,
                    ];
                })->toArray(),
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
                'items' => ProductGroup::query()->get()->map(function (ProductGroup $productGroup) {
                    return [
                        'name' => $productGroup->getTranslations('name'),
                        'menuable_type' => ProductGroup::class,
                        'menuable_id' => $productGroup->getKey(),
                        'position' => 1,
                        'route_name' => 'products.show',
                        'toplevel_id' => 3,
                    ];
                })->toArray(),
            ],
            [
                'name' => [
                    'ru' => 'Кладбища',
                    'uk' => 'Кладовища',
                ],
                'toplevel_id' => 0,
                'route_name' => 'cemeteries.list',
                'position' => 3,
                'menuable_type' => Cemetery::class,
                'menuable_id' => 0,
            ],
            [
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
            $menuitem = optional(Menuitem::query()->firstOrCreate($data) ?? null, function (Menuitem $menuitem) {
                return $menuitem;
            });
            collect($item['items'] ?? null)->each(function (array $data) use ($menuitem) {
                $data['toplevel_id'] = $menuitem->getKey();
                optional(Menuitem::query()->firstOrCreate($data) ?? null, function (Menuitem $menuitem) {
                    return $menuitem;
                });
            });
        }
    }

    public function asCommand()
    {
        $this->handle();
    }
}
