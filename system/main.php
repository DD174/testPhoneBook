<?php
require_once 'config.php';

/**
 * автолод на коленке... готовые библиотеки нельзя, по этому композер тут не поможет
 */
spl_autoload_register(
    static function ($class) {
        $path = __DIR__ .'/../'  . str_replace('\\', '/', $class) . '.php';
        if (file_exists($path)) {
            require_once $path;
        }
    }
);