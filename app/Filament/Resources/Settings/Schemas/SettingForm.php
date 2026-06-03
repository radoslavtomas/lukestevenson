<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('page_title')
                    ->required(),
                TextInput::make('page_subtitle')
                    ->required(),
                Textarea::make('page_description')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('page_keywords')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('address_line1')
                    ->required(),
                TextInput::make('address_line2')
                    ->required(),
                TextInput::make('address_line3')
                    ->required(),
                TextInput::make('postcode')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                Textarea::make('map')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
