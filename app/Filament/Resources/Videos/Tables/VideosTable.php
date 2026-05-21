<?php

namespace App\Filament\Resources\Videos\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class VideosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->label('Título del Video')
                    ->searchable()
                    ->sortable(),
                
                TextColumn::make('plataforma')
                    ->label('Plataforma')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'youtube' => 'danger',
                        'tiktok' => 'gray',
                        'instagram' => 'warning',
                        default => 'primary',
                    })
                    ->sortable(),

                IconColumn::make('esta_activo')
                    ->label('Status')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Fecha de Registro')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Filtros futuros si los requieres
            ]);
    }
}