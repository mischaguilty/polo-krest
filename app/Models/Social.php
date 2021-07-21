<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Social extends Model
{
    use HasFactory;

    protected $table = 'socials';

    protected $fillable = [
        'name',
        'url',
        'icon',
        'socialable_type',
        'socialable_id',
    ];

    public function socialable(): MorphTo
    {
        return $this->morphTo('socialable', 'socialable_type', 'socialable_id', 'id');
    }
}
