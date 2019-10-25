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
     * @var \system\Response
     */
    private $response;

    /**
     * Controller constructor.
     * @param Request|null $request
     * @param \system\Response|null $response
     */
    public function __construct(Request $request = null, \system\Response $response = null)
    {
        $this->request = $request ?: new Request();
        $this->response = $response ?: new \system\Response();
    }

    /**
     * @return \system\Response
     */
    abstract public function execute();

    protected function getRequest()
    {
        return $this->request;
    }

    /**
     * @return \system\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * список ролей которым разрешен доступ к этому котролеру
     * @return array
     */
    public function accessRoles()
    {
        return [
            \system\Rbac::ROLE_USER,
        ];
    }
}