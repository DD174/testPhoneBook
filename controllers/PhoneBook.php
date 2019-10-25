<?php


namespace controllers;


class PhoneBook extends \abstracts\Controller
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $this->getResponse()->setContent(
            (new \system\Render('phoneBook/index.php'))->getContent()
        );

        return $this->getResponse();
    }
}