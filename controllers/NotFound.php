<?php
namespace controllers;

use system\Request;

class NotFound implements \interfaces\Controller
{
    /**
     * @var Request
     */
    private $request;



    /**
     * @inheritDoc
     */
    public function execute()
    {
        $this->request;
        return new \system\Render(
            '404.php'
        );
    }
}