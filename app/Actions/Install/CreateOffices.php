<?php

namespace App\Actions\Install;

use App\Models\Company;
use App\Models\Office;
use App\Models\WorkingDay;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateOffices
{
    use AsAction;

    public function handle(Company $company = null)
    {
        optional($company ?? Company::query()->firstWhere([
                'id' => 1,]), function (Company $company) {
            $this->createOffices($company);
        });
    }

    public function createOffices($company)
    {
        foreach ([
                     [
                         'name' => __('Центральний офіс'),
                         'address' => [
                             'country' => __('Україна'),
                             'region' => __('Запорізька область'),
                             'zip_code' => __('69000'),
                             'city' => __('місто Запоріжжя'),
                             'street' => __('вулиця Якова Новицького'),
                             'building' => __('будинок 8'),
                             'latitude' => '47.841209',
                             'longitude' => '35.13348',
                             'place_id' => 'ChIJTcv1VhRn3EARjDNbW-dhR5A',
                         ],
                         'phones' => [[
                             'phone' => '+380682204202',
                         ]],
                     ],
                     [
                         'name' => __('Ще один офіс'),
                         'address' => [
                             'country' => __('Україна'),
                             'region' => __('Запорізька область'),
                             'zip_code' => __('69000'),
                             'city' => __('місто Запоріжжя'),
                             'street' => __('вулиця Орджонікідзе'),
                             'building' => __('будинок 45'),
                             'latitude' => '47.8922778',
                             'longitude' => '35.159978',
                             'place_id' => 'EnnQstGD0LvQuNGG0Y8g0J7RgNC00LbQvtC90ZbQutGW0LTQt9C1LCA0NSwg0JfQsNC_0L7RgNGW0LbQttGPLCDQl9Cw0L_QvtGA0ZbQt9GM0LrQsCDQvtCx0LvQsNGB0YLRjCwg0KPQutGA0LDRl9C90LAsIDY5MDAwIhoSGAoUChIJg6_lLkpm3EARA2dDF_aHWOkQLQ',
                         ],
                         'phones' => [[
                             'phone' => '+380981234567',
                         ]],
                     ],
                     [
                         'name' => __('ІЩЕ один офіс'),
                         'address' => [
                             'country' => __('Україна'),
                             'region' => __('Запорізька область'),
                             'zip_code' => __('69000'),
                             'city' => __('місто Запоріжжя'),
                             'street' => __('вулиця Леоніда Жаботинського'),
                             'building' => __('будинок 50'),
                             'latitude' => '47.8392756',
                             'longitude' => '35.1307685',
//                             'place_id' => 'EnnQstGD0LvQuNGG0Y8g0J7RgNC00LbQvtC90ZbQutGW0LTQt9C1LCA0NSwg0JfQsNC_0L7RgNGW0LbQttGPLCDQl9Cw0L_QvtGA0ZbQt9GM0LrQsCDQvtCx0LvQsNGB0YLRjCwg0KPQutGA0LDRl9C90LAsIDY5MDAwIhoSGAoUChIJg6_lLkpm3EARA2dDF_aHWOkQLQ',
                         ],
                         'phones' => [[
                             'phone' => '+380987654321',
                         ]],
                     ],
                 ] as $ofdata) {
            optional($company->offices()->firstOrCreate(
                    collect($ofdata)->only('name')->toArray()
                ) ?? null,
                function (Office $office) use ($ofdata) {
                    $office->address()->firstOrCreate($ofdata['address']);
                    collect($ofdata['phones'])->each(function ($phone) use ($office) {
                        $office->phones()->firstOrCreate($phone);
                    });

                    $workings = Collection::wrap([
                        'monday' => [
                            'start' => WorkingDay::getStartTimestampAfter(8),
                            'stop' => WorkingDay::getStopTimestampAfter(18),
                        ],
                        'tuesday' => [
                            'start' => WorkingDay::getStartTimestampAfter(8),
                            'stop' => WorkingDay::getStopTimestampAfter(18),
                        ],
                        'wednesday' => [
                            'start' => WorkingDay::getStartTimestampAfter(8),
                            'stop' => WorkingDay::getStopTimestampAfter(18),
                        ],
                        'thursday' => [
                            'start' => WorkingDay::getStartTimestampAfter(8),
                            'stop' => WorkingDay::getStopTimestampAfter(18),
                        ],
                        'friday' => [
                            'start' => WorkingDay::getStartTimestampAfter(8),
                            'stop' => WorkingDay::getStopTimestampAfter(17, 30),
                        ],
                        'saturday' => [
                            'start' => WorkingDay::getStartTimestampAfter(8),
                            'stop' => WorkingDay::getStopTimestampAfter(17),
                        ],
                        'sunday' => null,
                    ]);

                    $workings->keys()->each(function ($weekday) use ($office) {
                        $office->working_days()->firstOrCreate([
                            'weekday' => $weekday,
                        ]);
                    });

                    foreach ($workings as $weekday => $working) {
                        optional($working, function (array $working) use ($weekday, $office) {
                            optional($office->working_days()->firstWhere([
                                    'weekday' => $weekday,
                                ]) ?? null, function (WorkingDay $workingDay) use ($working) {
                                $workingDay->workings()->updateOrCreate($working);
                            });
                        });
                    }

                    return $office->refresh();
                });
        }
    }
}
