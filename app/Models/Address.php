<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected $table = 'addresses';

    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'latitude',
        'longitude',
        'place_id',
        'country',
        'region',
        'zip_code',
        'city',
        'street',
        'building',
        'flat',
    ];

    public function addressable(): MorphTo
    {
        return  $this->morphTo('adderessable', 'addressable_type', 'addressable_id', 'id');
    }

    public function getGeoRegionAttribute(): string
    {
        return 'UA-23';
    }

    public function getGeoPlacenameAttribute(): string
    {
        return trim(str_replace('місто', '', $this->city));
    }

    public function getSchemaStreetAttribute(): string
    {
        return trim(str_replace([
            __('улица'),
            __('вулиця'),
        ], '', $this->street));
    }

    public function getGeoPositionAttribute(): string
    {
        return implode(';', [
            $this->latitude,
            $this->longitude,
        ]);
    }

    public function getIcmbContentAttribute(): string
    {
        return implode(',', [
            $this->latitude,
            $this->longitude,
        ]);
    }

    public function getGoogleMapsAttribute(): string
    {
//        http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;output=embed

//        https://www.google.com/maps/embed/v1/place?key=AIzaSyB1Yt0zLkalNhq8X-bXoWBlqIuDQagcjDg&q=place_id:ChIJhQ5FRnJh3EARODFxJk5-ETQ&center=47.809529,35.057709&zoom=15&language=ru&
        return implode('?', [
            'https://maps.google.com/maps/embed/v1/place',
            implode('&', [
                implode('=', [
                    'key',
                    config('app.maps_key', 'AIzaSyCUsPLE4-8Cy4oL3N3_OIBqIdknQsuWiZE'),
                ]),
                implode('=', [
                    'q',
                    $this->place_query,
                ]),
                implode('=', [
                    'center',
                    $this->icmb_content,
                ]),
                implode('=', [
                    'zoom',
                    '15',
                ]),
                implode('=', [
                    'language',
                    app()->getLocale() === 'ua_UA' ? 'UK_uk' : 'RU_ru',
                ]),
            ]),
        ]);
    }

    public function getPlaceQueryAttribute($default = null)
    {
        return implode(':', [
            'place_id',
            Company::find(1)->offices->first()->address->place_id
        ]);

//        return $this->full_place_id
//            ?? optional($default
//                ?? optional($this->addressable,
//                    function ($model) {
//                        return $model->name;
//                    }
//                ),
//                function (string $default) {
//                    return implode(':', [
//                        'place',
//                        urlencode(implode(' ', [
//                            $default, $this->city_street_building
//                        ])),
//                    ]);
//                }
//            );
    }

    public function getFullPlaceIdAttribute(): ?string
    {
        return optional($this->place_id, function (string $placeId) {
            return implode(':', [
                'place_id',
                $placeId,
            ]);
        });
    }

//        return $this->place_id ? implode(':', [
//            'place_id',
//            $this->place_id,
//        ]) : ($default ?? urlencode($this->street_building));
//    }

    public function getStreetBuildingAttribute(): ?string
    {
        return trim(implode(', ', [
            $this->street,
            $this->building,
        ]), ', ');
    }

    public function getCityStreetBuildingAttribute(): string
    {
        return trim(implode(', ', [
            $this->city,
            $this->street,
            $this->building,
        ]), ', ');
    }
}
