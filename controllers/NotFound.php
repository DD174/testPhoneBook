<?php
namespace controllers;

class NotFound extends \abstracts\Controller
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