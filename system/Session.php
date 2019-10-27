<?php
namespace system;

/**
 * Class Session
 * @package system
 */
class Session
{
    /**
     *
     */
    private static function init()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public static function setSessionValue($name, $value)
    {
        self::init();

        $_SESSION[$name] = $value;
    }

    /**
     * Вернет значение из сессии, если такого значения нет, то вернет false
     * @param string $name
     * @return mixed|false
     */
    public static function getSessionValue($name)
    {
        self::init();
        if (!isset($_SESSION[$name])) {
            return false;
        }

        return $_SESSION[$name];
    }

    /**
     * Удалить значение из сессии
     * @param string $name
     */
    public static function delSessionValue($name)
    {
        self::init();
        if (isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
}