<?php

namespace Database\Factories;

use App\Models\ServiceGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceGroupFactory extends Factory
{
    protected $model = ServiceGroup::class;

    public function definition()
    {
        return app($this->model)->definition($this->faker);
    }
}
