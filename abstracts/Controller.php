<?php

namespace abstracts;

use system\Request;

/**
 * Interface Controller
 * @package interfaces
 */
abstract class Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * Controller constructor.
     * @param Request|null $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = $request ?: new Request();
    }

    /**
     * @return \system\Render
     */
    abstract public function execute();

    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * список ролей которым разрешен доступ к этому котролеру
     * @return array
     */
    public function accessRoles()
    {
        return [
            \system\Rbac::ROLE_GUEST,
        ];
    }
}