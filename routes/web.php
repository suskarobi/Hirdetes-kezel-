<?php

Route::get('update-hirdetes-pages', function () {
    \Z3d0X\FilamentFabricator\Models\Page::where('is_system', false)->update([
        'blocks' => [
            [
                'type' => 'hirdetes-aloldal',
                'data' => []
            ]
        ]
    ]);
});
