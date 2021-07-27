<?php

namespace App\Actions\Install;

use App\Models\Company;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCompany
{
    use AsAction;

    public string $commandSignature = 'install:create-company';

    public function handle(array $companyData = null)
    {
        return optional(Company::create($companyData), function (Company $company) {
            $company->addMediaCollection('logo');
            return $company;
        });
    }

    public function asCommand(Command $command)
    {
        $this->handle();
    }
}
