<?php


namespace controllers;


use models\phone\PhoneRepository;

class PhoneBook extends \abstracts\Controller
{
    /**
     * @var PhoneRepository
     */
    private $phoneRepository;

    public function __construct(
        \system\Request $request = null,
        \system\Response $response = null,
        PhoneRepository $phoneRepository = null
    )
    {
        $this->phoneRepository = $phoneRepository ?: new PhoneRepository();
        parent::__construct($request, $response);
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    public function execute()
    {
        $phones = $this->phoneRepository->getPhonesByUserId(\system\Rbac::getUser()->id);
        $dataProvider = new \system\DataProvider($phones);
        $dataProvider->setSort($this->getRequest()->getGet('sort'));

        $this->getResponse()->setContent(
            (new \system\Render(
                'phoneBook/index.php',
                [
                    'dataProvider' => $dataProvider
                ]
            ))->getContent()
        );

        return $this->getResponse();
    }
}