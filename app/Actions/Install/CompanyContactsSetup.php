<?php

namespace App\Actions\Install;

use App\Models\Company;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;

class CompanyContactsSetup
{
    use AsAction;

    public $commandSignature = 'install:company-contacts';


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
//                [
//                    'name' => 'facebook',
//                    'url' => 'https://www.facebook.com/Ritualzp',
//                    'icon' => 'fab fa-facebook-square',
//                ],
////                [                [
//                    'name' => 'facebook',
//                    'url' => 'https://www.facebook.com/Ritualzp',
//                    'icon' => 'fab fa-facebook-square',
//                ],
//                [
//                    'name' => 'instagram',
//                    'url' => 'https://www.instagram.com/vichnist_zp',
//                    'icon' => 'fab fa-instagram',
//                ],
//                    'name' => 'instagram',
//                    'url' => 'https://www.instagram.com/vichnist_zp',
//                    'icon' => 'fab fa-instagram',
//                ],
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

    public function AsCommand(Command $command)
    {
        $this->handle();
    }
}
