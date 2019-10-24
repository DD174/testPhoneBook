<?php
namespace controllers;

class Registration extends \abstracts\Controller
{
    public function execute()
    {
        $user = null; // TODO для работы с формой красивее сделать отдельный класс типа UserForm и в нем проверить капчу
        $errors = [];
        if ($this->getRequest()->isPost()) {
            $userService = new \models\user\UserService();
            try {
                $user = $userService->createUser($this->getRequest()->getPost());
            } catch (\system\DomainException $e) {
                $errors[] = $e->getMessage();
            }
        }

        return new \system\Render(
            'registration/form.php',
            [
                'user' => $user,
                'errors' => $errors,
            ]
        );
    }

    public function getForm()
    {
        return file_get_contents(VIEW_PATCH . 'registration/form.php');
    }

    public function createUser()
    {

    }
}