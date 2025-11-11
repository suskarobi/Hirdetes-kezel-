<?php

namespace App\Models;

use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'images' => 'array',
        'categories' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($news) {
            $generateNewSlug = 'hirdetes/' . $news->slug;
            $news->slug = $generateNewSlug;
            $news->save();

            \Z3d0X\FilamentFabricator\Models\Page::create([
                'title' => $news->title,
                'slug' => $generateNewSlug,
                'layout' => 'default',
                'blocks' => [
                    [
                        'type' => 'hirdetesek',
                        'data' => []
                    ]
                ],
                'is_system' => false
            ]);
        });

        static::deleting(function ($news) {
            $news->pages()->delete();
        });
    }

    public function pages()
    {
        return $this->hasMany(\Z3d0X\FilamentFabricator\Models\Page::class, 'slug', 'slug');
    }

    public function newsCategory()
    {
        $newsCategory = NewsCategory::whereIn('id', $this->categories)->pluck('name')->toArray();
        return implode(', ',$newsCategory);
    }
}
