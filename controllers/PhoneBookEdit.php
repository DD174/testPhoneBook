<?php


namespace controllers;

use models\phone\PhoneForm;
use models\phone\PhoneRepository;
use models\phone\PhoneService;

/**
 * Добавление/редактирование номера
 */
class PhoneBookEdit extends \abstracts\Controller
{
    /**
     * @var PhoneRepository
     */
    private $phoneRepository;
    /**
     * @var PhoneService
     */
    private $phoneService;

    /**
     * PhoneBookEdit constructor.
     * @param \system\Request|null $request
     * @param \system\Response|null $response
     * @param PhoneRepository|null $phoneRepository
     * @param PhoneService|null $phoneService
     */
    public function __construct(
        \system\Request $request = null,
        \system\Response $response = null,
        PhoneRepository $phoneRepository = null,
        PhoneService $phoneService = null
    )
    {
        $this->phoneRepository = $phoneRepository ?: new PhoneRepository();
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
        $info = [];
        $errors = [];
        if ($id = $this->getRequest()->getGet('id')) {
            $phone = $this->phoneRepository->getPhoneById($id);
        }

        $phoneForm = new PhoneForm($phone);

        if ($this->getRequest()->isPost()) {
            $phoneForm->load($this->getRequest()->getPost());
            try {
                $phone = $this->phoneService->createOrUpdatePhone($phoneForm);
                $phoneForm = new PhoneForm($phone);
                $info[] = 'Телефон сохранен';
            } catch (\system\DomainException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $this->getResponse()
            ->setLayout(false)
            ->setContent(
            (new \system\Render(
                'phoneBook/form.php',
                [
                    'phoneForm' => $phoneForm,
                    'errors' => $errors,
                    'info' => $info,
                ]
            ))->getContent()
        );

        return $this->getResponse();
    }
}