<?php

namespace web;

require_once '../system/main.php';

$controller = new \controllers\Registration();

new \system\Render(
    'layouts/main.php',
    [

    ]
);