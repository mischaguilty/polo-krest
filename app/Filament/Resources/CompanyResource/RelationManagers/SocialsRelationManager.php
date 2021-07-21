<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class SocialsRelationManager extends RelationManager
{
    public static $primaryColumn = '';

    public static $relationship = 'socials';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Icon::make('icon')->label('')->options([
//                    'default' =>
                ]),
                Columns\Text::make('name')->label(__('Назва'))->primary(),
            ])
            ->filters([
                //
            ]);
    }
}
