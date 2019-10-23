<?php

namespace system;

class Db
{
    private $connect;

    /**
     * @var self
     */
    private static $_instance;

    /**
     * без возможности наследовать
     */
    private function __construct()
    {
        try {
            $this->connect = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASSWORD);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * без возможности клонирования
     */
    private function __clone()
    {
    }

    /**
     * @return Db
     */
    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @param $sql
     * @return bool|PDOStatement
     */
    private function prepare($sql)
    {
        return $this->connect->prepare($sql);
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function fetch($sql, array $params)
    {
        $sth = $this->prepare($sql);
        $sth->execute($params ?: null);
        $res = $sth->fetch(PDO::FETCH_ASSOC);
        if ($res === false) {
            throw new Exception($sth->errorCode());
        }

        return $res;
    }
}