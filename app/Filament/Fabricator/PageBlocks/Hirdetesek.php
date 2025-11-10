<?php

namespace App\Filament\Fabricator\PageBlocks;

use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;
use App\Models\News;
use Filament\Forms\Components\TextInput;

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
        if(isset($data["paginate_number"])){
            $hirdetesek = News::where('is_active', true)->paginate($data["paginate_number"]);
        }else{
            $hirdetesek = News::where('is_active', true)->paginate(3);
        }

        foreach ($hirdetesek as $hirdetes) {
            $thumbnail = Media::find($hirdetes->thumbnail_image);
            // A rack_public disk közvetlenül a public/media mappát használja
            $hirdetes->thumbnail_url = $thumbnail ? asset($thumbnail->path) : null;

            $images = [];
            $imagesIds = is_array($hirdetes->images) ? $hirdetes->images : [];
            foreach ($imagesIds as $imgId) {
                $img = Media::find($imgId);
                if ($img) {
                    $images[] = asset($img->path);
                }
            }
            $hirdetes->images_urls = $images;
        }

        $data['hirdetesek'] = $hirdetesek;
        return $data;
    }
}
