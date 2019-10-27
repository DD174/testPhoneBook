<?php


namespace controllers;

use models\phone\PhoneService;

/**
 * Просмотр записи в телефонной книге
 */
class PhoneBookView extends \abstracts\Controller
{
    /**
     * @var PhoneService
     */
    private $phoneService;

    /**
     * PhoneBookEdit constructor.
     * @param \system\Request|null $request
     * @param \system\Response|null $response
     * @param PhoneService|null $phoneService
     */
    public function __construct(
        \system\Request $request = null,
        \system\Response $response = null,
        PhoneService $phoneService = null
    )
    {
        $this->phoneService = $phoneService ?: new PhoneService();
        parent::__construct($request, $response);
    }

    /**
     * @inheritDoc
     * TODO: сделать, чтобы нельзя было читать чужие номера
     * @throws \Exception
     */
    public function execute()
    {
        $phone = null;
        if ($id = (int)$this->getRequest()->getGet('id')) {
            $phone = $this->phoneService->getPhoneById($id);
        }

        $this->getResponse()
            ->setLayout(false)
            ->setContent(
            (new \system\Render(
                'phoneBook/view.php',
                [
                    'phone' => $phone,
                ]
            ))->getContent()
        );

        return $this->getResponse();
    }
}