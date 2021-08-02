<?php

namespace Database\Factories;

use App\Models\Cemetery;
use Illuminate\Database\Eloquent\Factories\Factory;

class CemeteryFactory extends Factory
{
    protected $model = Cemetery::class;

    public function definition()
    {
        return app($this->model)->definition($this->faker);
    }
}
