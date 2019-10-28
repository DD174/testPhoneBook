<?php

namespace models\phone;

/**
 * Модель для представления объекта "номер телефона" в веб-форме,
 * и последующего получения данных из формы и передачи их уже в виде объекта в бизнес-логику
 */
class PhoneForm
{
    const FIELD_ID = 'id';
    const FIELD_USER_ID = 'user_id';
    const FIELD_NAME = 'name';
    const FIELD_SURNAME = 'surname';
    const FIELD_PHONE = 'phone';
    const FIELD_EMAIL = 'email';
    const FIELD_AVATAR = 'avatar';

    public $id;
    public $userId;
    public $name;
    public $surname;
    public $phone;
    public $email;
    /**
     * @var \system\FileUpload|null
     */
    public $avatar;

    /**
     * @var Phone|null
     */
    private $phoneModel;

    /**
     * PhoneForm constructor.
     * @param Phone|null $phone
     */
    public function __construct(Phone $phone = null)
    {
        if ($phone) {
            $this->phoneModel = $phone;
            $this->id = $phone->id;
            $this->name = $phone->name;
            $this->surname = $phone->surname;
            $this->phone = $phone->phone;
            $this->email = $phone->email;
        }
    }

    /**
     * @param array $data
     */
    public function load($data)
    {
        $this->name = $data[self::FIELD_NAME];
        $this->surname = $data[self::FIELD_SURNAME];
        $this->phone = $data[self::FIELD_PHONE];
        $this->email = $data[self::FIELD_EMAIL];
    }

    /**
     * @param \system\FileUpload $file
     */
    public function setAvatar(\system\FileUpload $file)
    {
        $this->avatar = $file;
    }

    /**
     * Вернет объект номера который редактируем.
     * @return Phone|null
     */
    public function getOriginPhoneModel()
    {
        return $this->phoneModel;
    }
}