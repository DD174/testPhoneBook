<?php
namespace models\user;

class UserRepository
{
    /**
     * @var \system\Db
     */
    private $db;

    public function __construct()
    {
        $this->db = \system\Db::getInstance();
    }

    /**
     * @param User $user
     * @return User
     * @throws \system\DomainException
     * @throws \Exception
     */
    public function create(User $user)
    {
        $res = $this->db->insert(
            'INSERT INTO user (login, email, password) VALUES (:login, :email, :password)',
            [
                ':login' => $user->login,
                ':email' => $user->email,
                ':password' => $user->password,
            ]
        );
        if ($res === false) {
            throw new \system\DomainException('Не удалось создать пользователя в БД');
        }

        return $this->getByUserId($res);
    }

    /**
     * @param $id
     * @return User|null
     * @throws \Exception
     */
    public function getByUserId($id)
    {
        $row = $this->db->fetch('SELECT id, login, email FROM user WHERE id = :id', [':id' => $id]);
        if ($row) {
            return new User(
                $row['id'],
                $row['login'],
                $row['email']
            );
        }

        return null;
    }
}