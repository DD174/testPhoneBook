<?php
namespace models\phone;

/**
 * Объект номер телефона в телефонной книге
 */
class Phone
{
    public $id;
    public $userId;
    public $name;
    public $surname;
    public $phone;
    public $email;

    /**
     * Phone constructor.
     * @param int|null $id
     * @param int|null $userId
     * @param string|null $name
     * @param string|null $surname
     * @param int|null $phone
     * @param string|null $email
     */
    public function __construct($id = null, $userId = null, $name = null, $surname = null, $phone = null, $email = null)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->name = $name;
        $this->surname = $surname;
        $this->phone = $phone;
        $this->email = $email;
    }
}