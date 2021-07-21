<?php


namespace App\Traits;


use App\Models\Price;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPrice
{
    public function prices(): MorphMany
    {
        return $this->morphMany(Price::class, 'priceable', 'priceable_type', 'priceable_id')
            ->latest();
    }

    public function getCurrentPriceAttribute(): ?Price
    {
        return $this->prices()->get()->first();
    }
}
