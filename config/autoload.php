<?php

spl_autoload_register(function (string $className): void {
    $folders = [
        'controllers',
        'entities',
        'managers',
        'services'
    ];

    foreach ($folders as $folder) {
        $file = __DIR__ . '/../' . $folder . '/' . $className . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});