<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Page extends Model
{
    use HasFactory;

    protected $table = 'pages';

    protected $fillable = [
        'uri',
        'title',
        'description',
        'h_one',
        'view_title',
        'pageable_type',
        'pageable_id',
    ];

    public function pageable(): MorphTo
    {
        return $this->morphTo('pageable', 'pageable_type', 'pageable_id');
    }


    public static function getTitleSuffix(Company $company): string
    {
        return $company->title_suffix ?? config('app.name');
    }

    public static function suffixedTitle(string $title, Company $company, $separator = '|'): ?string
    {
        return implode(implode(' ', ['', $separator, '',]), [
            $title,
            self::getTitleSuffix($company),
        ]);
    }
}
