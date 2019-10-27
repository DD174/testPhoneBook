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

    /**
     * Вернет html ссылки с параметрами сортировки с указанным параметром
     * @param $name - отображаемое имя
     * @param $key - ключ
     * @param null $order - направление сортировки, если null, то сортировки по этому полю нет
     * @return string
     */
    public static function getLinkSort($name, $key, $order = null)
    {
        if ($order === \system\DataProvider::ASC) {
            $param = '-';
            $icon = '<i class="fas fa-sort-alpha-down"></i>';
        } else {
            $param = '';
            $icon = '<i class="fas fa-sort-alpha-down-alt"></i>';
        }
        if ($order === null) {
            $icon = '';
        }
        return '<a href="' . self::getCurrentUrl('sort', $param . $key) . '">'
            . htmlspecialchars($name)
            . $icon
            . '</a>';
    }

    /**
     * Вернет ссылку на текущую страницу с добавлением указанного параметра
     * @param string|null $key
     * @param null $value
     * @return string
     */
    public static function getCurrentUrl($key = null, $value = null)
    {
        // TODO: нужно заменить _GET на класс Request, но для начало надо это класс переделать на синглтон ;(
        $get = (array)$_GET;
        if ($key !== null) {
            $get[$key] = $value;
        }
        $res = [];
        foreach ($get as $k => $v) {
            $res[] = $k . '=' . urlencode($v);
        }

        return '?' . implode('&', $res);
    }

    /**
     * Пишет номер прописью.
     * Если номер начинается с "0", то напишет "ноль двести девять"
     * @param $number
     * @return string
     */
    public static function phoneNumberToWords($number)
    {
        if (preg_match('/^(?<zero>0*)(?<other>\d*)$/', $number, $matches) !== 1) {
            return '';
        }
        $str = '';
        if ($matches['zero'] !== '') {
            $str .= str_replace('0', 'ноль ', $matches['zero']);
        }
        if ($matches['other']) {
            $nf = new \NumberFormatter('ru', \NumberFormatter::SPELLOUT);
            $str .= $nf->format($matches['other']);
        }

        return trim($str);
    }
}