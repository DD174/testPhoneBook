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
}