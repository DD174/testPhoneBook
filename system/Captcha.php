<?php

namespace system;

/**
 * пародия на капчу :)
 *
 * TODO: надо сделать хэш капчи, чтобы передавать его из формы, чтобы можно было открыть одновременно одну и туже форму в разных вкладках
 */
class Captcha
{
    const SESSION_KEY_CAPTCHA = 'captcha';

    /**
     * @var string
     */
    private $question;
    /**
     * @var int
     */
    private $answer;

    /**
     * генерирует капчу. Одну на сессию, см. туду в начале класса
     */
    public function generate()
    {
        $n1 = mt_rand(0, 10);
        $n2 = mt_rand(0, 10);

        $this->question = 'Решите пример ' . $n1 . ' + ' . $n2;
        $this->answer = $n1 + $n2;

        Session::setSessionValue(self::SESSION_KEY_CAPTCHA, $this->answer);
    }

    /**
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @return int
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Проверяем правильность ответа
     * @param $answer
     * @return bool
     */
    public function checkAnswer($answer)
    {
        return Session::getSessionValue(self::SESSION_KEY_CAPTCHA) === (int)$answer;
    }
}