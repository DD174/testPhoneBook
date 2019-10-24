<?php

namespace controllers;

class Forbidden extends \abstracts\Controller
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return new \system\Render(
            '404.php'
        );
    }
}