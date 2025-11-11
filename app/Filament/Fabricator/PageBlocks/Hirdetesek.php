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
                TextInput::make('paginate_number')
                    ->numeric()
                    ->label('Elemek száma oldalanként'),
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

            $images = [];
            $imageIds = is_array($hirdetes->images) ? $hirdetes->images : [];

            foreach ($imageIds as $imgId) {
                $img = Media::find($imgId);
                if ($img) {
                    $images[] = asset('storage/app/public/' . $img->path);
                }
            }

            $hirdetes->images_urls = $images;
        }

        $data['hirdetesek'] = $hirdetesek;
        return $data;
    }

    /**
     * Egyedi metódus a részletek oldalhoz
     */
    public function show($slug)
    {
        $hirdetes = News::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Képkezelés
        $thumbnail = Media::find($hirdetes->thumbnail_image);
        $hirdetes->thumbnail_url = $thumbnail 
            ? asset('storage/app/public/' . $thumbnail->path) 
            : null;

        $images = [];
        $imageIds = is_array($hirdetes->images) ? $hirdetes->images : [];
        foreach ($imageIds as $imgId) {
            $img = Media::find($imgId);
            if ($img) {
                $images[] = asset('storage/app/public/' . $img->path);
            }
        }
        $hirdetes->images_urls = $images;

        // Fabricator oldal betöltése
        return view('filament-fabricator::page', [
            'page' => null,
            'blocks' => [
                [
                    'type' => 'hirdetes-reszletek',
                    'data' => [
                        'hirdetes' => $hirdetes,
                    ],
                ],
            ],
        ]);
    }
}
