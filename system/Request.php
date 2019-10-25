<?php

namespace system;

/**
 * Прослойка для работы с реквостом от клиента, на случай рефакторинга
 */
class Request
{
    /**
     * @var array
     */
    private $post;

    /**
     * @var array
     */
    private $get;

    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->post = $_POST;
        $this->get = $_GET;
    }

    /**
     * @param string|null $key
     * @return mixed
     */
    public function getPost($key = null)
    {
        if ($key === null) {
            return $this->post ?: [];
        }
        if (isset($this->post[$key])) {
            return $this->post[$key];
        }

        return null;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get ?: [];
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return (bool)$this->post;
    }
}