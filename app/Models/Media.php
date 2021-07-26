<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Schema\Blueprint;
use Spatie\Translatable\HasTranslations;

class Media extends \Spatie\MediaLibrary\MediaCollections\Models\Media
{
    use HasFactory;
    use HasTranslations;

    public array $translatable = [
        'name',
    ];

    protected $guarded = [];

    public function migration(Blueprint $table)
    {
        $table->bigIncrements('id');
        $table->morphs('model');
        $table->uuid('uuid')->nullable()->unique();
        $table->string('collection_name');
        $table->text('name');
        $table->string('file_name');
        $table->string('mime_type')->nullable();
        $table->string('disk');
        $table->string('conversions_disk')->nullable();
        $table->unsignedBigInteger('size');
        $table->json('manipulations');
        $table->json('custom_properties');
        $table->json('generated_conversions');
        $table->json('responsive_images');
        $table->unsignedInteger('order_column')->nullable();
        $table->nullableTimestamps();
    }
}
