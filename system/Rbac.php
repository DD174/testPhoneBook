<?php


namespace system;


class Rbac
{
    const ROLE_GUEST = 'guest';
    const ROLE_USER = 'user';

    /**
     * @return bool
     */
    public static function isAuthorized()
    {
        return false;
    }

    /**
     * @return string
     */
    public static function getUserRole()
    {
        if (self::isAuthorized()) {
            // TODO вернуть роль авторизованного юзера
        }
        return self::ROLE_GUEST;
    }
}