<?php

namespace App\Actions\Install;

use App\Models\Menuitem;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateMenu
{
    use AsAction;

    public string $commandSignature = 'install:create-menu';

    public function handle()
    {
        foreach ([
            [
                'name' => [
                    'ru' => 'О нас',
                    'uk' => 'Про нас',
                ],
                'toplevel_id' => 0,
                'route_name' => 'about',
                'position' => 0,
            ],
            [
                'name' => [
                    'ru' => 'Услуги',
                    'uk' => 'Послуги',
                ],
                'toplevel_id' => 0,
                'route_name' => 'services',
                'position' => 1,
            ],
            [
                'name' => [
                    'ru' => 'Атрибутика',
                    'uk' => 'Атрибутика',
                ],
                'toplevel_id' => 0,
                'route_name' => 'products',
                'position' => 2,
            ],
            [
                'name' => [
                    'ru' => 'Кладбища',
                    'uk' => 'Кладовища',
                ],
                'toplevel_id' => 0,
                'route_name' => 'cemeteries',
                'position' => 3,
            ],
            'contacts' => [
                'name' => [
                    'ru' => 'Контакты',
                    'uk' => 'Контакти',
                ],
                'toplevel_id' => 0,
                'route_name' => 'contacts',
                'position' => 4,
            ],
                     ] as $item) {
            Menuitem::create($item);
        }
    }

    public function asCommand(Command $command)
    {
        $this->handle();
    }
}
