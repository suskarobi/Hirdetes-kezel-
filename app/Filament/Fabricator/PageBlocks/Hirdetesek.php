<?php

namespace App\Filament\Fabricator\PageBlocks;

use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;
use App\Models\News;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Storage;

class Hirdetesek extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('hirdetesek')
            ->schema([
                TextInput::make("paginate_number")
                    ->numeric()
                    ->label("Elemek száma oldalanként")
            ]);
    }

    public static function mutateData(array $data): array
    {
        $perPage = $data['paginate_number'] ?? 3;

        $hirdetesek = News::where('is_active', true)->paginate($perPage);

        foreach ($hirdetesek as $hirdetes) {
            $thumbnail = Media::find($hirdetes->thumbnail_image);

            if ($thumbnail) {
                $hirdetes->thumbnail_url = asset('storage/app/public/' . $thumbnail->path);
            } else {
                $hirdetes->thumbnail_url = null;
            }
        }

        $data['hirdetesek'] = $hirdetesek;
        return $data;
    }
}
