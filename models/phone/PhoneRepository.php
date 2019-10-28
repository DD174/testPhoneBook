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
    const FIELD_AVATAR = 'avatar';

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
        if ($phone->newAvatar) {
            $phone->avatar = UPLOAD_PATH . DIRECTORY_SEPARATOR
                . md5(serialize([$phone->newAvatar, time()])) . '.' . $phone->newAvatar->getFileExtension();
        }
        $res = $this->db->insert(
            'INSERT INTO ' . self::TABLE_NAME . ' ('
            . self::FIELD_USER_ID . ', '
            . self::FIELD_NAME . ', '
            . self::FIELD_SURNAME . ', '
            . self::FIELD_PHONE . ', '
            . self::FIELD_EMAIL . ', '
            . self::FIELD_AVATAR . '
            ) VALUES (:user_id, :name, :surname, :phone, :email, :avatar)',
            [
                ':user_id' => $phone->userId,
                ':name' => $phone->name,
                ':surname' => $phone->surname,
                ':phone' => $phone->phone,
                ':email' => $phone->email,
                ':avatar' => $phone->avatar,
            ]
        );
        if ($res === false) {
            throw new \system\DomainException('Не удалось создать запись в БД');
        }

        if ($phone->newAvatar) {
            $phone->newAvatar->move($phone->avatar);
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
            . self::FIELD_EMAIL . ', '
            . self::FIELD_AVATAR . '
             FROM ' . self::TABLE_NAME . ' WHERE ' . self::FIELD_ID . ' = :id', [':id' => $id]);
        if ($row) {
            return new Phone(
                $row[self::FIELD_ID],
                $row[self::FIELD_USER_ID],
                $row[self::FIELD_NAME],
                $row[self::FIELD_SURNAME],
                $row[self::FIELD_PHONE],
                $row[self::FIELD_EMAIL],
                $row[self::FIELD_AVATAR]
            );
        }

        return null;
    }

    /**
     * @param $userId
     * @return array
     * @throws \Exception
     */
    public function getPhonesByUserId($userId)
    {
        $models = [];
        $rows = $this->db->fetchAll('SELECT '
            . self::FIELD_ID . ', '
            . self::FIELD_USER_ID . ', '
            . self::FIELD_NAME . ', '
            . self::FIELD_SURNAME . ', '
            . self::FIELD_PHONE . ', '
            . self::FIELD_EMAIL . ', '
            . self::FIELD_AVATAR . '
             FROM ' . self::TABLE_NAME . ' WHERE ' . self::FIELD_USER_ID . ' = :user_id', [':user_id' => $userId]);
        if ($rows) {
            foreach ($rows as $row) {
                $models[] = new Phone(
                    $row[self::FIELD_ID],
                    $row[self::FIELD_USER_ID],
                    $row[self::FIELD_NAME],
                    $row[self::FIELD_SURNAME],
                    $row[self::FIELD_PHONE],
                    $row[self::FIELD_EMAIL],
                    $row[self::FIELD_AVATAR]
                );
            }
        }

        return $models;
    }

    /**
     * @param Phone $phone
     * @return Phone|null
     * @throws \system\DomainException
     * TODO: реализовать в Db транзацкции, чтобы обернуть в них сохранение записи и перенос файла
     */
    public function update(Phone $phone)
    {
        if ($phone->newAvatar) {
            $phone->avatar = UPLOAD_PATH . DIRECTORY_SEPARATOR
                . md5(serialize([$phone->newAvatar, time()])) . '.' . $phone->newAvatar->getFileExtension();
        }
        $res = $this->db->update(
            'UPDATE ' . self::TABLE_NAME . ' SET '
            . self::FIELD_NAME . ' = :name, '
            . self::FIELD_SURNAME . ' = :surname, '
            . self::FIELD_PHONE . ' = :phone, '
            . self::FIELD_EMAIL . ' = :email, '
            . self::FIELD_AVATAR . ' = :avatar
            WHERE id = :id',
            [
                ':name' => $phone->name,
                ':surname' => $phone->surname,
                ':phone' => $phone->phone,
                ':email' => $phone->email,
                ':avatar' => $phone->avatar,
                ':id' => $phone->id,
            ]
        );
        if ($res === false) {
            throw new \system\DomainException('Не удалось обновить запись в БД');
        }

        if ($phone->newAvatar) {
            // TODO: удалять старые файлы :)
            $phone->newAvatar->move($phone->avatar);
        }
        return $phone;
    }
}