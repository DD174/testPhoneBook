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
    case 'phone-edit':
        $controller = new \controllers\PhoneBookEdit();
        break;
    case 'phone-view':
        $controller = new \controllers\PhoneBookView();
        break;
    case 'registration':
        $controller = new \controllers\Registration();
        break;
    case 'logout':
        $controller = new \controllers\Logout();
        break;
    default:
        $controller = new \controllers\NotFound();
}

// символическая проверка доступа
if (!in_array(\system\Rbac::getUserRole(), $controller->accessRoles(), true)) {
    $controller = new \controllers\Forbidden();
}

// TODO: есть смысл ввести режим PROD|DEBUG, чтобы скрывать или показывать ошибки
//try {
$response = $controller->execute();
//} catch (Exception $e) {
//    $response = new \system\Response();
//    $response->setContent('ошибка: ' . htmlspecialchars($e->getMessage()));
//}

switch (true) {
    case $response->isRedirect():
        header('Location: ' . $response->getRedirectUrl(), true, 302);
        break;
    case $response->isHtml():
        if ($layout = $response->getLayout()) {
            $render = new \system\Render(
                'layouts/' . $layout . '.php',
                ['content' => $response->getContent()]
            );

            echo $render->getContent();
        } else {
            echo $response->getContent();
        }
        break;
    default:
        echo 'упс';
}