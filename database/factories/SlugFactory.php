<?php

namespace Database\Factories;

use App\Models\Slug;
use Illuminate\Database\Eloquent\Factories\Factory;

class SlugFactory extends Factory
{
    protected $model = Slug::class;

    public function definition()
    {
        return app($this->model)->definition($this->faker);
    }
}
