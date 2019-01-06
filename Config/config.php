<?php

return [
    'name'         => 'Video',
    'cache-prefix' => 'bugrabuyrukcu_video_embed_',
    'files-path'   => '/assets/embed/',
    'thumb'        => [
        'width'   => 600,
        'height'  => 350,
        'mode'    => 'fit',
        'quality' => 80
    ],
    /*
    |--------------------------------------------------------------------------
    | Load additional view namespaces for a module
    |--------------------------------------------------------------------------
    | You can specify place from which you would like to use module views.
    | You can use any combination, but generally it's advisable to add only one,
    | extra view namespace.
    | By default every extra namespace will be set to false.
    */
    'useViewNamespaces' => [
        // Read module views from /Themes/<backend-theme-name>/views/modules/<module-name>
        'backend-theme' => false,
        // Read module views from /Themes/<frontend-theme-name>/views/modules/<module-name>
        'frontend-theme' => true,
        // Read module views from /resources/views/<module-name>
        'resources' => true,
    ],
];
