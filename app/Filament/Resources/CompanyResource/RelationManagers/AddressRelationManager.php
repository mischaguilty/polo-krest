<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class AddressRelationManager extends RelationManager
{
    public static $primaryColumn = 'city_street_building';

    public static $relationship = 'address';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('country')->label(__('Страна')),
                Components\TextInput::make('region')->label(__('Область')),
                Components\TextInput::make('city')->label(__('Населений пункт')),
                Components\TextInput::make('zip_code')->label(__('Індекс')),
                Components\TextInput::make('district')->label(__('Район')),
                Components\TextInput::make('street')->label(__('Вулиця')),
                Components\TextInput::make('building')->label(__('Будівля')),
                Components\TextInput::make('flat')->label(__('Квартира')),
                Components\TextInput::make('latitude')->label(__('Широта')),
                Components\TextInput::make('longitude')->label(__('Довгота')),
                Components\TextInput::make('place_id')->label(__('ID місця')),
            ])->columns(2);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('city_street_building')->label(__('Адреса')),
            ])
            ->filters([
                //
            ]);
    }
}
