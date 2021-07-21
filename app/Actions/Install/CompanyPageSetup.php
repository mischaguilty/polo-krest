<?php

namespace App\Actions\Install;

use App\Models\Company;
use App\Models\Page;
use Lorisleiva\Actions\Concerns\AsAction;

class CompanyPageSetup
{
    use AsAction;

    public function handle(Company $company = null)
    {
        return optional($company ?? Company::query()->firstWhere([
            'id' => 1,
            ]), function (Company $company) {
            return $company->page()->firstOrCreate([
                'uri' => '/',
                'title' => Page::suffixedTitle(__('Ритуальні послуги в Запоріжжі та області'), $company),
                'h_one' => __('Похоронне бюро "Вічність" - надія і опора в сумні хвилини скорботи. Цілодобово 24/7/365'),
                'description' => __('Заказ похорону, ритуальних товарів та послуг в Запоріжжі та області'),
                'view_title' => 'main',
            ]);
        });
    }
}
