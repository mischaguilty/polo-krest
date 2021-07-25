<?php

namespace App\Actions\Install;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateAdmin
{
    use AsAction;
    public $commandSignature = 'install:create-admin {name?}';

    public function handle(array $userData = null)
    {
        return optional($userData ?? [
                'email' => 'go.myke@gmail.com',
                'name' => 'mischa',
                'password' => bcrypt('123123123'),
        ], function (array $data) {
            return Schema::hasTable('users') && DB::table('users')->insert($data);
        });
    }

    public function AsCommand(Command $command)
    {
        $this->handle();
    }
}
