<?php

namespace App\Actions\Install;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAdmin
{
    use AsAction;

    private $usersTable = 'filament_users';

    public function handle(array $userData = null)
    {
        return optional($userData ?? [
                'email' => 'go.myke@gmail.com',
                'name' => 'mischa',
                'is_admin' => !0,
                'password' => bcrypt('123123123'),
        ], function (array $data) {
            return Schema::hasTable($this->usersTable)
                ? DB::table($this->usersTable)->insert($data)
                : false;
        });
    }
}
