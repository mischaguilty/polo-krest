<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompanyResource\Pages;
use App\Filament\Resources\CompanyResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class CompanyResource extends Resource
{
    public static $icon = 'heroicon-o-collection';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\Tabs::make(__('Компанія'))->tabs([
                    Components\Tab::make(__('Основні настройки'), [
                        Components\TextInput::make('name')
                            ->label(__('Назва'))
                            ->required()
                            ->autofocus()
                            ->disableAutocomplete()
                            ->unique('companies', 'name', true),
                        Components\Textarea::make('description')->label(__('Опис'))->nullable(),
                        Components\FileUpload::make('logo')
                            ->label(__('Логотип'))
                            ->nullable()
                            ->directory('images')
                            ->image(),
                    ]),
                    Components\Tab::make(__('Контакти'), [
                        Components\Fieldset::make(__('Телефон'), [
                            Components\TextInput::make('company.phone'),
                        ]),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Image::make('logo')->label('Лого')->url(function ($record) {
                    return self::generateUrl('edit', [
                        'record' => $record->id,
                    ]);
                }),
                Columns\Text::make('name')->label(__('Назва'))->primary()->sortable()->searchable(),
            ])
            ->filters([
                //
            ]);
    }

    public static function relations()
    {
        return [
            RelationManagers\PhonesRelationManager::class,
            RelationManagers\PageRelationManager::class,
            RelationManagers\SocialsRelationManager::class,
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListCompanies::routeTo('/', 'index'),
            Pages\CreateCompany::routeTo('/create', 'create'),
            Pages\EditCompany::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
