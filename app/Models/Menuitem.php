<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Menuitem extends Model
{
    use HasFactory;

    protected $table = 'menuitems';

    protected $fillable = [
        'topnavitem_id',
        'position',
        'name',
    ];

    public function topnavitem(): BelongsTo
    {
        return $this->belongsTo(Topnavitem::class, 'topnavitem_id', 'id');
    }
}
