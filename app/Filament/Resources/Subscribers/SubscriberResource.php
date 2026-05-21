<?php

namespace App\Filament\Resources\Subscribers;

// CORRECCIÓN CLAVE: Ruta real de la página para recursos simples (--simple)
use App\Filament\Resources\Subscribers\Pages\ManageSubscribers;
use App\Models\Subscriber;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SubscriberResource extends Resource
{
    protected static ?string $model = Subscriber::class;

    // Firma exacta para evitar errores de tipo en la herencia
    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Suscriptores';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Fecha de Registro')
                    ->dateTime()
                    ->sortable(),
            ])
            ->actions([
                // Dejamos las acciones vacías temporalmente para eliminar el error de clases
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSubscribers::route('/'),
        ];
    }
}