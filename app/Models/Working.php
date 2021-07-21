<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Working extends Model
{
    use HasFactory;

    protected $table = 'workings';

    protected $fillable = [
        'working_day_id',
        'start',
        'stop',
    ];

    public function getDurationAttribute()
    {
        return $this->stop - $this->start;
    }

    public function working_day(): BelongsTo
    {
        return $this->belongsTo(WorkingDay::class, 'working_day_id', 'id');
    }

}
