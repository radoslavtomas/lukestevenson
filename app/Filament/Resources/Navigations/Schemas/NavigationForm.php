<?php

namespace App\Filament\Resources\Navigations\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class NavigationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('route')
                    ->required(),
                TextInput::make('position')
                    ->required()
                    ->numeric(),
                Select::make('page_id')
                    ->relationship('page', 'name')
                    ->required(),
            ]);
    }
}
