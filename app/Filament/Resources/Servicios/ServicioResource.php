<?php

namespace App\Filament\Resources\Servicios;

use App\Filament\Resources\Servicios\Pages;
use App\Models\Servicio;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ServicioResource extends Resource
{
    protected static ?string $model = Servicio::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'nexura';

public static function form(\Filament\Schemas\Schema $form): \Filament\Schemas\Schema
{
    return $form
        ->schema([
            \Filament\Forms\Components\TextInput::make('nombre')
                ->required(),
            \Filament\Forms\Components\TextInput::make('precio')
                ->numeric()
                ->required(),
        ]);
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Creado el')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
           ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServicios::route('/'),
            'create' => Pages\CreateServicio::route('/create'),
            'edit' => Pages\EditServicio::route('/{record}/edit'),
        ];
    }
}