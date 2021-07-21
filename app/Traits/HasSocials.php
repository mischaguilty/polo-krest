<?php


namespace App\Traits;


use App\Models\Social;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasSocials
{
    public function socials(): MorphMany
    {
        return $this->morphMany(Social::class, 'socialable')->orderBy('name');
    }

    public function getFacebookAttribute()
    {
        return $this->socials()->firstWhere('name', 'LIKE', '%facebook%');
    }

    public function getTelegramAttribute()
    {
        return $this->socials()->firstWhere('name', 'LIKE', '%telegram%');
    }
}
