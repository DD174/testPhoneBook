<?php
namespace controllers;

use system\Request;

class Registration implements \interfaces\Controller
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request ?: new Request();
    }

    public function execute()
    {
        $user = null;
        if ($this->request->isPost()) {
            $this->createUser();
        }

        return new \system\Render(
            'registration/form.php',
            [
                'user' => $user,
            ]
        );
    }

    public function getForm()
    {
        return file_get_contents(VIEW_PATCH . 'registration/form.php');
    }

    public function createUser()
    {

    }
}