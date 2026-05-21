<?php

namespace App\Filament\Resources\Videos\Schemas;

use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                \Filament\Schemas\Components\Section::make('Detalles del Video Viral')
                    ->description('Registra tus TikToks o videos de YouTube para Nexura Lab.')
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('titulo')
                            ->label('Título del Video')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        \Filament\Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique('videos', 'slug', ignoreRecord: true),

                        \Filament\Forms\Components\Select::make('plataforma')
                            ->options([
                                'youtube' => 'YouTube',
                                'tiktok' => 'TikTok',
                                'instagram' => 'Instagram Reels',
                            ])
                            ->required()
                            ->default('tiktok'),

                        \Filament\Forms\Components\TextInput::make('video_url')
                            ->label('URL / Enlace del Video')
                            ->placeholder('https://www.tiktok.com/@nexuralab/video/...')
                            ->required()
                            ->url(),

                        \Filament\Forms\Components\Textarea::make('descripcion')
                            ->label('Resumen / Descripción Corta (Opcional)')
                            ->rows(3)
                            ->columnSpanFull(),

                        \Filament\Forms\Components\Toggle::make('esta_activo')
                            ->label('¿Visible en la plataforma web?')
                            ->default(true),
                    ])->columns(2),
            ]);
    }
}