<?php

namespace controllers;

class Forbidden extends \abstracts\Controller
{
    /**
     * @var \models\user\UserRepository
     */
    private $userRepository;

    /**
     * Forbidden constructor.
     * @param \system\Request|null $request
     * @param \models\user\UserRepository|null $userRepository
     */
    public function __construct(\system\Request $request = null, \models\user\UserRepository $userRepository = null)
    {
        parent::__construct($request);
        $this->userRepository = $userRepository ?: new \models\user\UserRepository();
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function execute()
    {
        $errors = [];
        if ($this->getRequest()->isPost()) {
            $user = $this->userRepository->getUserByLogin($this->getRequest()->getPost('login'));
            if ($user && \system\Rbac::authorization($user, $this->getRequest()->getPost('password'))) {
                $this->getResponse()->setRedirect('/');
            } else {
                $errors[] = 'Логин и пароль не верные';
            }
        }


        $this->getResponse()->setContent(
            (new \system\Render('403.php', ['errors' => $errors]))->getContent()
        );

        return $this->getResponse();
    }
}