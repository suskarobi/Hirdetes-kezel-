<?php

namespace App\Filament\Fabricator\PageBlocks;

use App\Models\News;
use Awcodes\Curator\Models\Media;
use Filament\Forms\Components\Builder\Block;
use Illuminate\Support\Facades\Storage;
use Z3d0X\FilamentFabricator\PageBlocks\PageBlock;

class HirdetesAloldal extends PageBlock
{
    public static function getBlockSchema(): Block
    {
        return Block::make('hirdetes-aloldal')
            ->schema([]);
    }

    public static function mutateData(array $data): array
    {
        $pageSlug = request()->route()->parameter('filamentFabricatorPage');

        if($pageSlug){
            $data['hirdetes'] = News::where('slug', $pageSlug->slug)->first();

            if ($data['hirdetes']->thumbnail_image) {
                $thumbnail = Media::find($data['hirdetes']->thumbnail_image);
                $data['hirdetes']->thumbnail_url = $thumbnail ? asset('storage/app/public/' .$thumbnail->path) : null;
            } else {
                $data['hirdetes']->thumbnail_url = null;
            }

            if (is_array($data['hirdetes']->images)) {
                foreach ($data['hirdetes']->images as $imgId) {
                    $img = Media::find($imgId);
                    if ($img) {
                       $images[]  = asset('storage/app/public/' .$img->path);
                    }
                }
                $data['hirdetes']->images_urls = $images ?? [];
            }
        }

        return $data;
    }
}
