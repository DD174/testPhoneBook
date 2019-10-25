<?php


namespace system;


class Rbac
{
    const ROLE_GUEST = 'guest';
    const ROLE_USER = 'user';
    const SESSION_KEY_AUTHORIZED_USER_ID = 'authorizedUserId';

    /**
     * если авторизован, то здесь будет модель авторизованного пользователя
     * @var \models\user\User
     */
    private static $user;

    /**
     * @return \models\user\User|null
     * @throws \Exception
     */
    public static function getUser()
    {
        if (self::$user === null) {
            $userRepository = new \models\user\UserRepository();
            self::$user = $userRepository->getUserById(Session::getSessionValue(self::SESSION_KEY_AUTHORIZED_USER_ID));
        }

        return self::$user;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public static function isAuthorized()
    {
        return  self::getUser() !== null;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public static function getUserRole()
    {
        if (self::isAuthorized()) {
            return self::ROLE_USER;
        }
        return self::ROLE_GUEST;
    }

    /**
     * @param \models\user\User $user
     * @param string $password
     * @return bool
     */
    public static function authorization(\models\user\User $user, $password)
    {
        if ($user->password === $password) {
            Session::setSessionValue(self::SESSION_KEY_AUTHORIZED_USER_ID, $user->id);

            return true;
        }
        return false;
    }
}