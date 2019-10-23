<?php

require_once '../system/main.php';

// "роутинг"... такой, т.к. если писать что-то стоящее, то это отдельная задача...
$action = null;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
switch ($action) {
    case 'registration':
        $controller = new \controllers\Registration();
        break;
    default:
        $controller = new NotFound();
}