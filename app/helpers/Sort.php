<?php


namespace app\helpers;


class Sort
{
    private $sort;

    public $fields = [
        'category_id',
        'created_at',
    ];

    /**
     * Sort constructor.
     */
    public function __construct()
    {
        $sortParam = ArrayHelper::getValue('sort', $_GET, '');
        $params = explode(',', $sortParam);
        $sort = [];
        foreach ($params as $param) {
            [$field, $direction] = explode('.', $param);
            if (in_array($field, $this->fields, true)) {
                $sort[$field] = $direction;
            }
        }
        $this->sort = $sort;
    }


    public function __toString()
    {
        if (!$this->sort) {
            return '';
        }
        $order = [];
        foreach ($this->sort as $field => $direction) {
            $direction = $direction === 'desc'
                ? 'DESC'
                : '';
            $order[] = "`{$field}` {$direction}";
        }
        $order = implode(', ', $order);
        return " ORDER BY " . $order;
    }

    /**
     * @return array
     */
    public function getSort(): array
    {
        return $this->sort;
    }
}
