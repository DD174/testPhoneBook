<?php
namespace controllers;

/**
 * Регистрация пользователя
 */
class Registration extends \abstracts\Controller
{
    /**
     * @inheritDoc
     */
    public function accessRoles()
    {
        return [
            \system\Rbac::ROLE_GUEST,
        ];
    }

    public function execute()
    {
        $user = null; // TODO для работы с формой красивее сделать отдельный класс типа UserForm и в нем проверить капчу
        $errors = [];
        $captcha = new \system\Captcha();
        if ($this->getRequest()->isPost()) {
            if ($captcha->checkAnswer($this->getRequest()->getPost('answer'))) {
                $userService = new \models\user\UserService();
                try {
                    $user = $userService->createUser($this->getRequest()->getPost());
                    if (\system\Rbac::authorization($user, $user->password)) {
                        $this->getResponse()->setRedirect('/');
                    }
                } catch (\system\DomainException $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = 'Ответ не верный!';
            }
        }

        $captcha->generate();

        $this->getResponse()->setContent(
            (new \system\Render(
                'registration/form.php',
                [
                    'user' => $user,
                    'errors' => $errors,
                    'captcha' => $captcha,
                ]
            ))->getContent()
        );
        return $this->getResponse();
    }
}