<?php

namespace App\Models;

use App\Traits\HasAddress;
use App\Traits\HasPhones;
use App\Traits\HasSocials;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;
use Spatie\Translatable\HasTranslations;

class Company extends Model implements HasMedia
{
    use HasFactory;
    use Notifiable;

    use HasAddress;
    use HasPhones;
    use HasSocials;

    use HasTranslations;
    use InteractsWithMedia;

    public static string $DEFAULT_NAME = 'Test Company';

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'description',
    ];

    protected array $translatable = [
        'name',
        'description',
    ];

    public function offices(): HasMany
    {
        return $this->hasMany(Office::class, 'company_id', 'id')->orderBy('name');
    }

    public function getDcTitleAttribute()
    {
        return $this->name;
    }

    public function getTitleSuffixAttribute(): string
    {
        $title = optional($this->address ?? null, function (Address $address) {
            return implode(' - ', [
                $this->name,
                $address->city,
            ]);
        });
        return $title ?? $this->name;
    }

    public function menuitem(): MorphMany
    {
        return $this->morphMany(Menuitem::class, 'menuable', 'menuable_type', 'menuable_id', 'id');
    }

    public function routeNotificationForTelegram(): string
    {
        return '1666886280';
//        return optional($this->socials()->firstWhere([
//            'name' => 'telegram',
//        ]), function (Social $social) {
//            return $social->chat_id;
//        });
    }

    public function page()
    {
        return $this->morphMany(Page::class, 'pageable', 'pageable_type', 'pageable_id', 'id');
    }
}
