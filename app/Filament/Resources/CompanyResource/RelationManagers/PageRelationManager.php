<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class PageRelationManager extends RelationManager
{
    /**
     * @return string
     */
    public static function getEditModalHeading(): string
    {
        return 'Редагувати';
    }

    public static $primaryColumn = 'uri';

    public static $relationship = 'page';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('uri')->label(__('URL'))->required(),
                Components\TextInput::make('title')->label('<title>'),
                Components\Textarea::make('description')->label(__('meta description')),
                Components\TextInput::make('h_one')->label('<h1>'),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('uri')->label(__('URL'))->sortable()->searchable()->url(function ($record) {
                    return url($record->uri);
                })->formatUsing(function ($uri) {
                    return url($uri);
                })->openUrlInNewTab(),
            ])
            ->filters([
                //
            ])->pagination(false);
    }
}
