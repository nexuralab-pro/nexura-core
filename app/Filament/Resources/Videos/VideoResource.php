<?php

namespace App\Filament\Resources\Videos;

use App\Filament\Resources\Videos\Pages\CreateVideo;
use App\Filament\Resources\Videos\Pages\EditVideo;
use App\Filament\Resources\Videos\Pages\ListVideos;
use App\Filament\Resources\Videos\Pages\ViewVideo;
use App\Filament\Resources\Videos\Schemas\VideoForm;
use App\Filament\Resources\Videos\Schemas\VideoInfolist;
use App\Filament\Resources\Videos\Tables\VideosTable;
use App\Models\Video;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    // Cambiado a un ícono de Video más descriptivo para el menú izquierdo
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedVideoCamera;

    protected static ?string $recordTitleAttribute = 'titulo';

    public static function form(Schema $schema): Schema
    {
        // Esto manda a llamar la configuración de tu archivo de formulario dedicado
        return VideoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return VideoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // Esto manda a llamar la configuración de tu archivo de tabla dedicado
        return VideosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            // Aquí puedes meter relaciones en el futuro
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVideos::route('/'),
            'create' => CreateVideo::route('/create'),
            'view' => ViewVideo::route('/{record}'),
            'edit' => EditVideo::route('/{record}/edit'),
        ];
    }
}