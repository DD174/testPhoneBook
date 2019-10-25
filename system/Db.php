<?php

namespace system;

use PDO;
use PDOException;
use PDOStatement;

class Db
{
    /**
     * @var PDO
     */
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

    }

    /**
     * без возможности клонирования
     */
    private function __clone()
    {
    }

    /**
     *
     */
    private function init()
    {
        if ($this->connect === null) {
            try {
                $this->connect = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST, DB_USER, DB_PASSWORD);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
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
     * @return PDOStatement
     * @throws PDOException
     */
    private function prepare($sql)
    {
        $this->init();

        /** @noinspection PhpIncompatibleReturnTypeInspection */
        return $this->connect->prepare($sql);
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     * @throws \Exception
     */
    public function fetch($sql, array $params)
    {
        $sth = $this->prepare($sql);
        $sth->execute($params ?: null);
        $res = $sth->fetch(PDO::FETCH_ASSOC);
        if ($res === false) {
            throw new \Exception($sth->errorCode());
        }

        return $res;
    }

    /**
     * @param string $sql
     * @param array $params
     * @return bool
     * @throws DomainException
     */
    private function execute($sql, array $params)
    {
        $sth = $this->prepare($sql);

        if ($sth->execute($params ?: null) === false) {
            throw new DomainException(implode(' ', $sth->errorInfo()));
        }

        return true;
    }

    /**
     * TODO: ради приличия (будущего рефакторинга) для разных операций сделал свои методы, по факту все они вызывают выполнение переданного запроса
     * @param string $sql
     * @param array $params
     * @return int|false
     * @throws DomainException
     */
    public function insert($sql, array $params)
    {
        $this->init();
        try {
            $this->connect->beginTransaction();
            $this->execute($sql, $params);
            $res = $this->connect->lastInsertId();
            $this->connect->commit();

            return $res;
        } catch(PDOException $e) {
            $this->connect->rollback();
            throw new DomainException($e->getMessage());
        }
    }
}