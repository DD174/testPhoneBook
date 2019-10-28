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
     * @param string|null $key
     * @return mixed
     */
    public function getGet($key = null)
    {
        if ($key === null) {
            return $this->get ?: [];
        }
        if (isset($this->get[$key])) {
            return $this->get[$key];
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return (bool)$this->post;
    }

    /**
     * @param string $name
     * @return FileUpload|null
     */
    public function getFile($name)
    {
        if (isset($_FILES[$name])) {
            return new FileUpload($_FILES[$name]);
        }

        return null;
    }
}