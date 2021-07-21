<?php

namespace App\Filament\Resources\CompanyResource\RelationManagers;

use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\RelationManager;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;

class PhonesRelationManager extends RelationManager
{
    public static $primaryColumn = 'phone';

    public static $relationship = 'phones';

    public static function form(Form $form)
    {
        return $form
            ->schema([
                Components\TextInput::make('phone')->label(__('Телефон'))
                    ->required()->autofocus()->autocomplete('off'),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('phone')->label(__('Телефон'))
                    ->primary()->searchable()->sortable(),
            ]);
    }
}
