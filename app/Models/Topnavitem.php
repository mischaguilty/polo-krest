<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topnavitem extends Model
{
    use HasFactory;

    protected $table = 'topnavitems';

    protected $fillable = [
        'name',
        'position',
        'uri',
    ];

    protected $with = [
        'menuitems',
    ];

    protected $withCount = [
        'menuitems',
    ];

    public function menuitems(): HasMany
    {
        return $this->hasMany(Menuitem::class, 'topnavitem_id', 'id')
            ->orderBy('position')
            ->orderBy('name');
    }
}
