<?php

namespace system;

/**
 * рисовалка вьюшек
 */
class Render
{
    private $content;

    /**
     * Render constructor.
     * @param $file
     * @param array $params
     */
    public function __construct($file, $params = [])
    {
        ob_start();
        ob_implicit_flush(false);
        extract($params, EXTR_OVERWRITE);
        try {
            /** @noinspection PhpIncludeInspection */
            require VIEW_PATCH . '/' . $file;
            $this->content = ob_get_clean();
        } catch (\Exception $e) {
            $this->content = $e->getMessage();
        }
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}