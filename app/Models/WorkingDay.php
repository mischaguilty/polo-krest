<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Carbon;

class WorkingDay extends Model
{
    use HasFactory;

    protected $table = 'working_days';

    protected $fillable = [
        'workable_type',
        'workable_id',
        'weekday',
    ];

    public function workable(): MorphTo
    {
        return $this->morphTo('workable', 'workable_type', 'workable_id', 'id');
    }

    public function workings():HasMany
    {
        return $this->hasMany(Working::class, 'working_day_id', 'id')->orderBy('start');
    }

    public static function getAfterHoursTimestamp($hours = null, $minutes = null)
    {
        return Carbon::createMidnightDate()->addHours((int)$hours)->addMinutes((int)$minutes)->timestamp - Carbon::createMidnightDate()->timestamp;
    }

    public static function getStartTimestampAfter($hours = null, $minutes = null)
    {
        return self::getAfterHoursTimestamp($hours, $minutes);
    }

    public static function getStopTimestampAfter($hours = null, $minutes = null)
    {
        return self::getAfterHoursTimestamp($hours, $minutes);
    }
}
