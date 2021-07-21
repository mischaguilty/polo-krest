<?php

namespace App\Actions\Install;

use App\Models\Company;
use Illuminate\Console\Command;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateCompany
{
    use AsAction;

    public $commandSignature = 'install:create-company {name?}';

    public function handle(array $companyData)
    {
        return optional(Company::create($companyData), function (Company $company) {
            return $company;
        });
    }

    public function asCommand(Command $command)
    {
        optional($command->hasArgument('name') ? $command->argument('name') : null, function (string $name) use ($command) {
            $command->info('Creating company "'.$name.'"');
            $company = optional($this->handle([
                'name' => $name,
            ]), function (Company $company) {
                return $company;
            });
            if ($company) {
                $command->info('Company '.$company->name.' created!');
                $command->line('');
            } else {
                $command->warn('Can not create "'.$name.'"');
            }
        });
    }
}
