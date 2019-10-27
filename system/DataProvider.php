<?php

namespace system;

/**
 * Для работы со списком. Умеет сортировать массив по одному полю.
 * При желание можно сделать поддержку сортировки по нескольким полям
 *
 * TODO нет валидации на корректность параметров, т.е. будет ломаться если передать не массив или задать не существующее поле для сортировки
 */
class DataProvider
{
    const DESC = SORT_DESC;
    const ASC = SORT_ASC;

    /**
     * @var array
     */
    private $items;

    /**
     * @var string|null
     */
    private $sortKey;

    /**
     * @var string|null
     */
    private $sortOrder;

    /**
     * DataProvider constructor.
     * @param array $items
     */
    public function __construct($items)
    {
        $this->items = $items;
    }

    /**
     * Задает поле по которому сортировать. "-" перед именем сделать обратную сортировку
     * @param $value
     * @return DataProvider
     */
    public function setSort($value)
    {
        $value = trim($value);
        if (!$value) {
            $this->sortKey = null;
            $this->sortOrder = null;

            return $this;
        }

        if (strpos($value, '-') === 0) {
            $this->sortOrder = self::DESC;
        } else {
            $this->sortOrder = self::ASC;
        }
        $this->sortKey = ltrim($value, '-');

        return  $this;
    }

    /**
     * Вернет отсортированный массив
     * TODO: для экономии можно сохранять отсортированный массив, чтобы не сортировать повторно. Но это зависит от контекста использования метода
     * @return array
     */
    public function getItems()
    {
        $this->sort();

        return $this->items;
    }

    /**
     * если задана сортировка, то отсортирует массив
     */
    private function sort()
    {
        if ($this->sortKey !== null) {
            $values = array_column($this->items, $this->sortKey);
            array_multisort(
                $values,
                $this->sortOrder,
                SORT_FLAG_CASE,
                $this->items
            );
        }
    }

    /**
     * Вернет направление сортировки для указанного поля. Если сортировки по этому полю нет, то вернет null
     * @param string $key
     * @return string|null
     */
    public function getCurrentSortForKey($key)
    {
        if ($this->sortKey && $this->sortKey === $key) {
            return $this->sortOrder;
        }

        return null;
    }
}