<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Phone extends Model
{
    use HasFactory;

    protected $table = 'phones';

    protected $fillable = [
        'phone',
        'phoneable_type',
        'phoneable_id',
    ];

    public function phoneable(): MorphTo
    {
        return $this->morphTo('phoneable', 'phoneable_type', 'phoneable_id', 'id');
    }

    public function getSpacedPhoneAttribute(): string
    {
        return Str::replaceLast(' ', '', implode(' ', collect(str_split($this->phone, 3))->toArray()));
    }
}
