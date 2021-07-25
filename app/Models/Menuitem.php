<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menuitem extends Model
{
    use HasFactory;

    protected $table = 'menuitems';

    protected $fillable = [
        'toplevel_id',
        'position',
        'name',
    ];

    public function scopeTopmenu(Builder $builder)
    {
        $builder->where([
            'toplevel_id' => 0,
        ]);
    }

    public function toplevel()
    {
        return Menuitem::query()->find($this->toplevel_id);
    }

    public function children()
    {
        return Menuitem::query()->where([
            'toplevel_id' => $this->getKey(),
        ])->get();
    }

    public function getChildrenCountAttribute(): int
    {
        return $this->children()->count();
    }
}
