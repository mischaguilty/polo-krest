<?php

namespace Database\Seeders;

use App\Actions\Install\CreateAdmin;
use App\Actions\Install\CreateCompany;
use App\Actions\Install\CreateMenu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        CreateAdmin::make()->handle();
        CreateCompany::make()->handle([
            'name' => [
                'uk' => 'Вічність',
                'ru' => 'Вечность',
            ],
        ]);
        CreateMenu::make()->handle();
    }
}
