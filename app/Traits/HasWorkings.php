<?php


namespace App\Traits;


use App\Models\WorkingDay;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasWorkings
{
    public function working_days(): MorphMany
    {
        return $this->morphMany(WorkingDay::class, 'workable', 'workable_type', 'workable_id', 'id')->with('workings');
    }
}
