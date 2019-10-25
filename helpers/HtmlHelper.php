<?php


namespace helpers;

/**
 * Class HtmlHelper
 * @package helpers
 */
class HtmlHelper
{
    /**
     * @param string[] $errors
     * @return string
     */
    public static function getErrorAlert($errors)
    {
        if ($errors) {
            return '<div class="alert alert-danger" role="alert">'
                . implode('<br>', $errors)
             . '</div>';
        }
        return '';
    }
}