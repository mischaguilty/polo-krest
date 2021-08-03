<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded = [];

    public static array $pageableTypes = [
        Company::class,
        ProductGroup::class,
        ServiceGroup::class,
    ];

    protected array $translatable = [
        'title',
        'description',
        'h1',
    ];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->text('title');
        $table->text('description');
        $table->text('h1');
        $table->string('pageable_type');
        $table->unsignedBigInteger('pageable_id')->nullable()->default(0);
        $table->foreignIdFor(Slug::class, 'slug_id')->nullable();
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public function pageable(): MorphTo
    {
        return $this->morphTo('pageable', 'pageable_type', 'pageable_id', 'id');
    }

    public function slug(): BelongsTo
    {
        return $this->belongsTo(Slug::class, 'slug_id', 'id');
    }
}
