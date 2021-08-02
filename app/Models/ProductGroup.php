<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Translatable\HasTranslations;

class ProductGroup extends Model implements \Spatie\MediaLibrary\HasMedia
{
    use HasFactory;
    use HasTranslations;
    use \Spatie\MediaLibrary\InteractsWithMedia;

    protected $guarded = [];

    protected array $translatable = [
        'name',
        'description',
    ];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->text('name');
        $table->text('description')->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function menuitem(): MorphOne
    {
        return $this->morphOne(Menuitem::class, 'menuable', 'menuable_type', 'menuable_id', 'id');
    }
}
