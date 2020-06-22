<?php


namespace app\sys\db;


use app\helpers\Sort;

class QueryLOSParams
{
    /**
     * @var int
     */
    public $limit = 51;

    /**
     * @var int
     */
    public $offset = 0;

    /**
     * @var Sort
     */
    public $sort;

    public function __construct()
    {
        $this->sort = new Sort();
    }

    public function __toString()
    {
        $sql = '' . $this->sort;
        $sql .= " LIMIT {$this->limit}";
        $sql .= " OFFSET {$this->offset}";
        return $sql;
    }
}
