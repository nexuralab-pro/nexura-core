<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('contenido')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('imagen_portada')
                    ->required(),
                TextInput::make('imagen_cuerpo')
                    ->required(),
                TextInput::make('url_afiliado')
                    ->default(null),
                TextInput::make('texto_boton_afiliado')
                    ->required()
                    ->default('Ver oferta en Mercado Libre'),
                TextInput::make('visitas')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('esta_activo')
                    ->required(),
            ]);
    }
}
