<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Schema\Blueprint;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Translatable\HasTranslations;

class Slug extends Model
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'name',
    ];

    public function migration(Blueprint $table)
    {
        $table->id();
        $table->text('name')->nullable();
        $table->morphs('sluggable');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
    }

    public static function defaultArray(): array
    {
        return [
            'name' => collect(LaravelLocalization::getSupportedLanguagesKeys())->mapWithKeys(function (string $locale) {
                return [
                    $locale => null,
                ];
            })->toArray(),
        ];
    }

    public function sluggable(): MorphTo
    {
        return $this->morphTo('sluggable');
    }

}
