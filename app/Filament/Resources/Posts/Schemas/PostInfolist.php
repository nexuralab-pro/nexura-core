<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class PostInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titulo'),
                TextEntry::make('slug'),
                TextEntry::make('contenido')
                    ->columnSpanFull(),
                TextEntry::make('imagen_portada'),
                TextEntry::make('imagen_cuerpo'),
                TextEntry::make('url_afiliado')
                    ->placeholder('-'),
                TextEntry::make('texto_boton_afiliado'),
                TextEntry::make('visitas')
                    ->numeric(),
                IconEntry::make('esta_activo')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
