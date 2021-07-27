<?php

namespace App\Actions\Install;

use App\Models\Company;
use Lorisleiva\Actions\Concerns\AsAction;

class CompanyContactsSetup
{
    use AsAction;

    public string $commandSignature = 'install:company-contacts';


    public function handle()
    {
        optional(Company::query()->firstWhere('id', '=', 1) ?? null, function (Company $company) {
            $company->phones()->firstOrCreate([
                'phone' => '+380682204202'
            ]);

            $this->createSocials($company);
        });
    }

    public function createSocials(Company $company)
    {
        foreach (
            [
                [
                    'name' => 'telegram',
                    'url' => 'https://www.t.me/VichnistAgent',
                    'icon' => 'fab fa-telegram-plane',
                    'chat_id' => '1666886280',
                ],
            ] as $socialData) {
            $company->socials()->firstOrCreate($socialData);
        }
    }

    public function AsCommand()
    {
        $this->handle();
    }
}
