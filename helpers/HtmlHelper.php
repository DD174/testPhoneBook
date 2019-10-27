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
        return self::getAlert($errors, 'danger');
    }

    /**
     * @param string[] $info
     * @return string
     */
    public static function getInfoAlert(array $info)
    {
        return self::getAlert($info, 'success');
    }

    /**
     * @param string[] $arr
     * @param string $type
     * @return string
     */
    public static function getAlert(array $arr, $type = 'danger')
    {
        if ($arr) {
            return '<div class="alert alert-' . $type . '" role="alert">'
                . implode('<br>', $arr)
                . '</div>';
        }
        return '';
    }
}