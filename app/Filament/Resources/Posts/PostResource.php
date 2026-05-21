<?php

namespace App\Filament\Resources\Posts;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Filament\Resources\Posts\Pages\ViewPost;
use App\Filament\Resources\Posts\Schemas\PostForm;
use App\Filament\Resources\Posts\Schemas\PostInfolist;
use App\Filament\Resources\Posts\Tables\PostsTable;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Titulo';

  public static function form(\Filament\Schemas\Schema $form): \Filament\Schemas\Schema
{
    return $form
        ->schema([
            \Filament\Schemas\Components\Section::make('Contenido Viral')
                ->description('Escribe algo que la gente quiera compartir en redes.')
                ->schema([
                    \Filament\Forms\Components\TextInput::make('titulo')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', \Illuminate\Support\Str::slug($state))),
                    
                    \Filament\Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(\App\Models\Post::class, 'slug', ignoreRecord: true),
                    
                    \Filament\Forms\Components\RichEditor::make('contenido')
                        ->required()
                        ->columnSpanFull(),
                ])->columns(2),

            // SECCIÓN: BLOQUES MODULARES (EXPANDIDA CON OPCIONES FUTURAS)
            \Filament\Schemas\Components\Section::make('Estructura Avanzada de la Nota')
                ->description('Agrega elementos en el orden que quieras para retener al usuario.')
                ->schema([
                    Builder::make('bloques')
                        ->hiddenLabel()
                        ->blocks([
                            // BLOQUE: PÁRRAFO
                            Builder\Block::make('parrafo')
                                ->label('Párrafo de Texto Extra')
                                ->icon('heroicon-o-document-text')
                                ->schema([
                                    Textarea::make('contenido')
                                        ->label('Escribe tu texto aquí')
                                        ->rows(4)
                                        ->required(),
                                ]),

                            // BLOQUE: IMAGEN EXTRA
                            Builder\Block::make('imagen')
                                ->label('Imagen Extra')
                                ->icon('heroicon-o-camera')
                                ->schema([
                                    FileUpload::make('ruta')
                                        ->label('Selecciona la Imagen')
                                        ->directory('posts-contenido')
                                        ->image()
                                        ->required(),
                                    TextInput::make('pie_foto')
                                        ->label('Pie de foto / Descripción (Opcional)'),
                                ]),

                            // BLOQUE: VIDEO EMBEBIDO
                            Builder\Block::make('video')
                                ->label('Video Embebido (YouTube/TikTok)')
                                ->icon('heroicon-o-video-camera')
                                ->schema([
                                    TextInput::make('url')
                                        ->label('Enlace del Video')
                                        ->placeholder('Ej: https://www.youtube.com/watch?v=...')
                                        ->required(),
                                ]),

                            // BLOQUE NUEVO: RECUADRO DE TEXTO DESTACADO / ALERTA (Súper útil para datos perturbadores)
                            Builder\Block::make('alerta')
                                ->label('Recuadro de Alerta / Destacado')
                                ->icon('heroicon-o-exclamation-triangle')
                                ->schema([
                                    TextInput::make('titulo_alerta')
                                        ->label('Título del recuadro')
                                        ->default('DATO PERTURBADOR:')
                                        ->required(),
                                    Textarea::make('texto_alerta')
                                        ->label('Contenido de la alerta')
                                        ->required(),
                                ]),

                            // BLOQUE NUEVO: INYECTOR DE ANUNCIO ESPECÍFICO (Para cuando quieras meter un banner gigante a mitad de texto)
                            Builder\Block::make('bloque_adsense')
                                ->label('Anuncio AdSense Manual (Alto Impacto)')
                                ->icon('heroicon-o-currency-dollar')
                                ->schema([
                                    Textarea::make('codigo_anuncio')
                                        ->label('Código Script de Google AdSense')
                                        ->placeholder('')
                                        ->rows(4)
                                        ->required(),
                                ]),
                        ])
                        ->columnSpanFull()
                ]),

            \Filament\Schemas\Components\Section::make('Imágenes y Monetización Base')
                ->schema([
                    \Filament\Forms\Components\FileUpload::make('imagen_portada')
                        ->image()
                        ->directory('posts-portadas')
                        ->extraAttributes([
        'onpaste' => 'event.stopPropagation();',
    ])
                        ->required(),
                    
                    \Filament\Forms\Components\FileUpload::make('imagen_cuerpo')
                        ->image()
                        ->directory('posts-contenido')
                        ->extraAttributes([
        'onpaste' => 'event.stopPropagation();',
    ])
                        ->required(),
                    
                    \Filament\Forms\Components\TextInput::make('url_afiliado')
                        ->label('Link de Mercado Libre / Amazon')
                        ->url()
                        ->prefix('https://'),
                    
                    \Filament\Forms\Components\TextInput::make('texto_boton_afiliado')
                        ->placeholder('Ej: Ver oferta en Mercado Libre'),
                ])->columns(2),

            // NUEVA SECCIÓN OCULTA/OPCIONAL: ESTRATEGIA Y SEO FUTURO
            \Filament\Schemas\Components\Section::make('Estrategia de Tráfico y SEO (Opcional)')
                ->description('Configuraciones avanzadas para posicionar en Google.')
                ->collapsible() // Esto permite que la sección se pueda encoger para que no estorbe
                ->collapsed()   // Aparece cerrada por defecto
                ->schema([
                    TextInput::make('meta_keywords')
                        ->label('Palabras Clave (Separadas por comas)')
                        ->placeholder('terror, virus, hacking, tecnologia, nexura lab'),
                    
                    Textarea::make('meta_description')
                        ->label('Descripción para los resultados de Google')
                        ->rows(2)
                        ->maxLength(160)
                        ->placeholder('Escribe un resumen atractivo de menos de 160 caracteres para enganchar clics desde Google.'),
                ])->columns(1),
        ]);
}

    public static function infolist(Schema $schema): Schema
    {
        return PostInfolist::configure($schema);
    }

    public static function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\ImageColumn::make('imagen_portada')
                    ->label('Miniatura'),
                \Filament\Tables\Columns\TextColumn::make('titulo')
                    ->searchable()
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('visitas')
                    ->label('Tráfico')
                    ->badge()
                    ->color('success')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Publicado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Aquí podrías filtrar por activos/inactivos luego
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'view' => ViewPost::route('/{record}'),
            'edit' => EditPost::route('/{record}/edit'),
        ];
    }
}