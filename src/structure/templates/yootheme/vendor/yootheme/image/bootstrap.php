<?php

namespace YOOtheme;

return [

    'routes' => [
        ['get', '/theme/image', ImageController::class . '@get', ['allowed' => true, 'save' => true]],
    ],

    'aliases' => [
        ImageProvider::class => 'image',
    ],

    'services' => [

        ImageProvider::class => function (Config $config) {
            return new ImageProvider($config('image.cacheDir'), [
                'route' => 'theme/image',
                'secret' => $config('app.secret'),
            ]);
        },

    ],

];
