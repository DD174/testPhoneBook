<?php

require_once '../system/main.php';

// "роутинг"... такой, т.к. если писать что-то стоящее, то это отдельная задача...
$action = '';
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
switch ($action) {
    case '':
        $controller = new \controllers\PhoneBook();
        break;
    case 'registration':
        $controller = new \controllers\Registration();
        break;

    default:
        $controller = new \controllers\NotFound();
}

// символическая проверка доступа
if (!in_array(\system\Rbac::getUserRole(), $controller->accessRoles(), true)) {
    $controller = new \controllers\Forbidden();
}

$render = new \system\Render(
    'layouts/main.php',
    ['content' => $controller->execute()->getContent()]
);

echo $render->getContent();