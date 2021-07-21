<?php

namespace Database\Seeders;

use App\Actions\Install\CompanyContactsSetup;
use App\Actions\Install\CompanyPageSetup;
use App\Actions\Install\CreateAdmin;
use App\Actions\Install\CreateCompany;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        CreateAdmin::run();
        CreateCompany::run([
            'name' => 'Вічність',
        ]);

        CompanyContactsSetup::run();
        CompanyPageSetup::run();
    }
}
