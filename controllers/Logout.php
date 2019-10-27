<?php

namespace controllers;

class Logout extends \abstracts\Controller
{
    /**
     * @inheritDoc
     */
    public function accessRoles()
    {
        return [\system\Rbac::ROLE_GUEST];
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function execute()
    {
        \system\Rbac::logout();

        $this->getResponse()->setRedirect('/');

        return $this->getResponse();
    }
}