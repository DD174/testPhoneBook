<?php
namespace models\phone;

/**
 * Объект номер телефона в телефонной книге
 */
class Phone
{
    // константы из-за того, что через веб передаются эти поля для сортировки списка телефонов. Так себе решение, 
    // но так, хотя бы не потеряются эти поля , если нужно будет их удалить или переименовать
    const FIELD_NAME = 'name';
    const FIELD_SURNAME = 'surname';

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