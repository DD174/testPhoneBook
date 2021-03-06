<?php

namespace models\user;

use system\DomainException;

class UserService
{
    const REGEXP_PWD = '^([a-zA-Z]+\d+|\d+[a-zA-Z]+)[a-zA-Z\d]*$';
    const REGEXP_LOGIN = '^[a-zA-Z0-9]+$';

    /**
     * @var User
     */
    private $user;

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    /**
     * @param array $userData
     * @return User
     * @throws DomainException
     */
    public function createUser(array $userData)
    {
        $this->user = new User(
            null,
            trim($userData[User::FIELD_LOGIN]),
            trim($userData[User::FIELD_EMAIL]),
            trim($userData[User::FIELD_PASSWORD])
        );

        $this->checkUser();

        $this->user = $this->userRepository->create($this->user);

        return $this->user;
    }

    /**
     * В случае ошибки в данные будет ExceptionDomain
     * @return bool
     * @throws DomainException
     */
    private function checkUser()
    {
        if (preg_match('/' . self::REGEXP_LOGIN . '/u', $this->user->login) !== 1) {
            throw new DomainException('Логин должен быть только из английских букв или цифр');
        }

        // TODO: можно написать одним патерном, но давно с регекспами не работал - не стал тратить время на воспоминания
        if (preg_match('/' . self::REGEXP_PWD .'/u', $this->user->password) !== 1) {
            throw new DomainException('Пароль должен содержать и цифры, и буквы');
        }

        if (preg_match('/.+@.+\..+/iu', $this->user->email) !== 1) {
            throw new DomainException('Укажите корректный email');
        }

        return true;
    }
}