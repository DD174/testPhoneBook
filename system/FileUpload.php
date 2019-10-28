<?php


namespace system;

/**
 * Для удобной работы с загруженными файлами
 */
class FileUpload
{
    private $name;
    private $type;
    private $size;
    private $tmpName;
    private $error;

    /**
     * FileUpload constructor.
     * @param array $file $_FILES['name']
     */
    public function __construct(array $file)
    {
        $this->name = $file['name'];
        $this->type = $file['type'];
        $this->size = $file['size'];
        $this->tmpName = $file['tmp_name'];
        $this->error = $file['error'];
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @return mixed
     */
    public function getTmpName()
    {
        return $this->tmpName;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Расширение файла
     * @return string
     */
    public function getFileExtension()
    {
        return preg_replace('#(^.*/)#', '', mime_content_type($this->getTmpName()));
    }

    /**
     * @param string $destination
     * @return bool
     */
    public function move($destination)
    {
        $destination = WEB_ROOT . $destination;
        return move_uploaded_file($this->getTmpName(), $destination);
    }
}