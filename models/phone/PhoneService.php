<?php

namespace models\phone;

use system\DomainException;

/**
 * Класс реализующий бизнес-логику работы с номером телефона (Phone)
 */
class PhoneService
{
    /**
     * @var Phone
     */
    private $phone;

    /**
     * @var PhoneRepository
     */
    private $phoneRepository;

    public function __construct($phoneRepository = null)
    {
        $this->phoneRepository = $phoneRepository ?: new PhoneRepository();
    }

    /**
     * @param PhoneForm $phoneForm
     * @return Phone
     * @throws DomainException
     * @throws \Exception
     */
    public function createOrUpdatePhone(PhoneForm $phoneForm)
    {
        if (!$this->phone = $phoneForm->getOriginPhoneModel()) {
            $this->phone = new Phone();
            $this->phone->userId = \system\Rbac::getUser()->id;
        } elseif ($this->phone->userId !== \system\Rbac::getUser()->id) {
            throw new DomainException('Нельзя редактировать чужой номер');
        }
        $this->phone->name = $phoneForm->name;
        $this->phone->surname = $phoneForm->surname;
        $this->phone->phone = $phoneForm->phone;
        $this->phone->email = $phoneForm->email;

        $this->check();

        if (!$this->phone->id) {
            $this->phone = $this->phoneRepository->create($this->phone);
        } else {
            $this->phone = $this->phoneRepository->update($this->phone);
        }

        return $this->phone;
    }

    /**
     * В случае ошибки в данные будет DomainException
     * @return bool
     * @throws DomainException
     */
    private function check()
    {
        // в номере сохраняем только числа. Формат номера не важен.
        $this->phone->phone = preg_replace('/[^0-9]/', '', $this->phone->phone);

        if (preg_match('/^[\w\s\-]+$/i', $this->phone->name) !== 1) {
            throw new DomainException('Имя может содержать только буквы, цифры, пробелы');
        }

        if ($this->phone->email && preg_match('/.+@.+\..+/i', $this->phone->email) !== 1) {
            throw new DomainException('Укажите корректный email');
        }

        return true;
    }
}