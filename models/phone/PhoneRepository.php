<?php

namespace models\phone;

/**
 * Класс ORM для сохранения объекта Phone в БД, и чтения из БД
 */
class PhoneRepository
{
    // константы здесь используются для того, чтобы легче было искать в коде места где используются название полей
    // это проще, чем искать просто текст "name" в коде всего проекта ;)
    const TABLE_NAME = 'phone';

    const FIELD_ID = 'id';
    const FIELD_USER_ID = 'user_id';
    const FIELD_NAME = 'name';
    const FIELD_SURNAME = 'surname';
    const FIELD_PHONE = 'phone';
    const FIELD_EMAIL = 'email';

    /**
     * @var \system\Db
     */
    private $db;

    public function __construct()
    {
        $this->db = \system\Db::getInstance();
    }

    /**
     * @param Phone $phone
     * @return Phone
     * @throws \system\DomainException
     * @throws \Exception
     */
    public function create(Phone $phone)
    {
        $res = $this->db->insert(
            'INSERT INTO ' . self::TABLE_NAME . ' ('
            . self::FIELD_USER_ID . ', '
            . self::FIELD_NAME . ', '
            . self::FIELD_SURNAME . ', '
            . self::FIELD_PHONE . ', '
            . self::FIELD_EMAIL . '
            ) VALUES (:user_id, :name, :surname, :phone, :email)',
            [
                ':user_id' => $phone->userId,
                ':name' => $phone->name,
                ':surname' => $phone->surname,
                ':phone' => $phone->phone,
                ':email' => $phone->email,
            ]
        );
        if ($res === false) {
            throw new \system\DomainException('Не удалось создать запись в БД');
        }

        return $this->getPhoneById($res);
    }

    /**
     * @param $id
     * @return Phone|null
     * @throws \Exception
     */
    public function getPhoneById($id)
    {
        $row = $this->db->fetch('SELECT '
            . self::FIELD_ID . ', '
            . self::FIELD_USER_ID . ', '
            . self::FIELD_NAME . ', '
            . self::FIELD_SURNAME . ', '
            . self::FIELD_PHONE . ', '
            . self::FIELD_EMAIL . '
             FROM ' . self::TABLE_NAME . ' WHERE ' . self::FIELD_ID . ' = :id', [':id' => $id]);
        if ($row) {
            return new Phone(
                $row[self::FIELD_ID],
                $row[self::FIELD_USER_ID],
                $row[self::FIELD_NAME],
                $row[self::FIELD_SURNAME],
                $row[self::FIELD_PHONE],
                $row[self::FIELD_EMAIL]
            );
        }

        return null;
    }
}