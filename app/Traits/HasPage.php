<?php


namespace App\Traits;


use App\Models\Page;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasPage
{
    public function page(): MorphOne
    {
        return $this->morphOne(Page::class, 'pageable', 'pageable_type', 'pageable_id', 'id');
    }
}
