<?php
namespace controllers;

class NotFound extends \abstracts\Controller
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $this->getResponse()
            ->setContent(
                (new \system\Render(
                    '404.php'
                ))->getContent()
            );

        return $this->getResponse();
    }
}