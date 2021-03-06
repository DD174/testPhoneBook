<?php

namespace system;

/**
 * Ответ от сервера
 */
class Response
{
    const TYPE_HTML = 'html';
    const TYPE_JSON = 'json';
    private $type = self::TYPE_HTML;
    private $content;
    private $redirectUrl;
    private $layout = 'main';

    /**
     * @param string $type
     * @return Response
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param mixed $content
     * @return Response
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * если, false, то значит layout не используется
     * @param string|false $layout
     * @return Response
     */
    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * @return string|false
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * TODO: можно добавить вторым параметром "номер" редиректа
     * @param $url
     * @return Response
     */
    public function setRedirect($url)
    {
        $this->redirectUrl = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        return $this->redirectUrl;
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        return $this->redirectUrl !== null;
    }

    /**
     * @return bool
     */
    public function isHtml()
    {
        return $this->type === self::TYPE_HTML;
    }

    /**
     * @return bool
     */
    public function isJson()
    {
        return $this->type === self::TYPE_JSON;
    }
}